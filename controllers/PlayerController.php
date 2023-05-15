<?php

namespace app\controllers;

use app\components\VideoStream;
use Yii;
use yii\web\Controller;

class PlayerController extends Controller
{
    public function actionPlay($id = null)
    {
//        Yii::$app->response->format = Yii::$app->response::FORMAT_RAW;
//        Yii::$app->response->headers->set('Content-Type: video/mp4');
//        Yii::$app->response->stream = Yii::$app->fs->readStream('');
        $videoPath = 'IMG_8759.mp4';
//
//// Set the appropriate headers
//        header('Content-Type: video/mp4');
//        header('Content-Length: ' . filesize($videoPath));
//
//// Open the video file
//        $file = fopen($videoPath, 'rb');
//
//// Start streaming the video
//        while (!feof($file)) {
//            // Set the chunk size (adjust as needed)
//            $chunkSize = 1024 * 1024; // 1MB
//
//            // Output the video in chunks
//            echo fread($file, $chunkSize);
//
//            // Flush the output buffer
//            ob_flush();
//            flush();
//
//            // Delay between chunks (adjust as needed)
//            usleep(500000); // 0.5 seconds
//        }
//
//// Close the file
//        fclose($file);
        $stream = new VideoStream($videoPath);
        $stream->start();
    }

    public function actionIndex($id = null)
    {
        return $this->render('index');
    }
}