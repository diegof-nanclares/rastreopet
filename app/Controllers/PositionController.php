<?php

namespace Controllers;
use Models\Position\PostionTrackingModel;
use Models\Utils\Logger;
use Models\Mails\Mail;
use Models\Utils\Util;

/**
 * Class PetController
 * @package Controllers
 */
class PositionController extends Admin\BaseController
{
    private $positionTrackingModel;

    private $logger;

    private $mail;
    public function __construct()
    {
        parent::__construct();
        $this->positionTrackingModel = new PostionTrackingModel();
        $this->logger = new Logger();
        $this->mail = new Mail();
    }
    public function save()
    {
        $lat = $_POST['lat'] ?? null;
        $long = $_POST['long'] ?? null;
        $petId = $_POST['pet_id'] ?? null;
        $qrId = $_POST['qr_identifier'] ?? null;
        $petName = $_POST['pet_name'] ?? null;
        $email = $_POST['email'] ?? null;
        $currentDateTime = date("Y-m-d H:i:s");

        try{
            $this->positionTrackingModel->setAttribute('latitude', $lat);
            $this->positionTrackingModel->setAttribute('longitude', $long);
            $this->positionTrackingModel->setAttribute('pet_id', $petId);
            $this->positionTrackingModel->setAttribute('qr_identifier', $qrId);
            $this->positionTrackingModel->setAttribute('created_at', $currentDateTime);
            $this->positionTrackingModel->save();
            $formattedDate = Util::formatDateTimeFull($currentDateTime);

            $templateVars = [
                'name' => $petName,
                'hour' => $formattedDate,
                'imagePlaceholder' => "https://jobstoreblog.s3-accelerate.amazonaws.com/magazine/wp-content/uploads/2020/02/google-map-features-.jpg",
                'coordinates' =>   $lat . "," . $long
            ];

            $emailTemplate = Util::getTemplateContents('located', '', $templateVars);
            $this->mail->sendmail($email, 'Se ha escaneado la plaquita de ' . $petName, $emailTemplate);
            $success = true;
        } catch (\Exception $exception) {
            $success = false;
            $this->logger->logError('500', self::class . 'An error occurred when trying to save pet position: ' . $exception->getMessage());
        }
    }
}
