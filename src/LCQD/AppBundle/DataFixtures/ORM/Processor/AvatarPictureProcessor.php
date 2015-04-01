<?php

namespace LCQD\AppBundle\DataFixtures\ORM\Processor;

use GuzzleHttp\Client;
use LCQD\PlaystationBundle\Entity\Picture;
use LCQD\PlaystationBundle\Model\AvatarInterface;
use Nelmio\Alice\ProcessorInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * AvatarPictureProcessor
 * 
 * @author lechatquidanse
 */
class AvatarPictureProcessor implements ProcessorInterface
{
    /**
     * path where are temporary saved picture
     */
    const TMP_FOLDER = __DIR__ . '/../../../../../../var/tmp/fixtures';

    /**
     * Pre Process
     * 
     * Processes an object before it is persisted to DB
     * Create picture to fill avatar pictures
     * 
     * @param object $object instance to process
     */
    public function preProcess($object)
    {
        if (!$object instanceof AvatarInterface) {
            return;
        }

        $nbCreate = rand(0, 5);

        for ($i=0; $i < $nbCreate; $i++) {
            $picture = $this->createOne();

            if ($picture instanceof Picture) {
                $object->addPicture($picture);
                $picture->preUpload();
                $picture->upload();
            }

            $picture = null;
        }
    }

    /**
     * Post Process
     * 
     * Processes an object before it is persisted to DB
     *
     * @param object $object instance to process
     */
    public function postProcess($object)
    {
        if (is_dir(self::TMP_FOLDER)) {
            rmdir(self::TMP_FOLDER);
        }
    }

    /**
     * Curl Picture File
     * 
     * Curl a picture from an url and save it in tmp folder
     * 
     * @param  string $sourceSave tmp path to save picture
     */
    private function curlPictureFile($sourceSave)
    {
        $client = new Client();
        $response = $client->get('http://lorempixel.com/400/500/', ['save_to' => $sourceSave]);

        if (200 != $response->getStatusCode()) {
            throw new Exception("Error Processing Request, no image", 1);
        }
    }

    /**
     * Create One
     * 
     * Create One picture for fixtures
     * 
     * @return Picture|null
     * @todo process when exception is catched
     */
    public function createOne()
    {
        try {
            if (!is_dir(self::TMP_FOLDER)) {
                mkdir(self::TMP_FOLDER);
            }

            $curlPictureFile = self::TMP_FOLDER . '/picture_' . mt_rand(0, 100000) . '.jpg';
            $this->curlPictureFile($curlPictureFile);

            $picture = new Picture();
            $file = new File($curlPictureFile);
            $picture->setFile($file);

            return $picture;
        } catch (\Exception $e) {
            return;
        }
    }
}
