<?PHP
include 'class.webhookHelper.php';
$webhookHelper = new webhookHelper();

    $data = json_decode(file_get_contents('php://input'), true);
    $dummyTimestamp = 1556194032; // Dummy
    $dataUsername = $data['username'];
    $dataType = $data['dataType'];
    $dataContent = $data['data'];
    switch($dataType){
        case 'msg':
            $username = $dataContent['username'];
            $FromMe = $dataContent['FromMe'];
            $RemoteJid = $dataContent['RemoteJid'];
            $Status = $dataContent['Status'];
            $Timestamp = $dataContent['Timestamp'];
            $msgId = $dataContent['msgId'];
            $msgInfo = $dataContent['msgInfo'];
            $msgType = $msgInfo['msgType'];
            switch($msgType){
                case 'text':
                    $messageText = $msgInfo['message'];
                    // echo back, whatever is received
                    if($FromMe!=1){
                        // Message is Not sent by me
                        if($Timestamp>$dummyTimestamp){
                            // only to attach replies with message received after $dummyTimestamp
                            if($messageText="TEST"){
                                // Text Message
                                //$webhookHelper->addReplyTextMessage($dataUsername,$RemoteJid,"[Plain] Hello, Text :)");
                                //$webhookHelper->addReplyTextMessage($dataUsername,$RemoteJid,"[Regional] नमस्ते!");
                                //$webhookHelper->addReplyTextMessage($dataUsername,$RemoteJid,"[Emoji] 😍");
                                //$webhookHelper->addReplyTextMessage($dataUsername,$RemoteJid,"[Bold] *Hello*");
                                //$webhookHelper->addReplyTextMessage($dataUsername,$RemoteJid,"[Italic] _Hello_");
                                //$webhookHelper->addReplyTextMessage($dataUsername,$RemoteJid,"[strikethrough] ~Hello~");
                                
                                // Media Message
                                //$webhookHelper->addReplyMediaMessage($dataUsername,$RemoteJid,"sample.jpg","https://www.sample-videos.com/img/Sample-jpg-image-50kb.jpg","[JPG]");
                                //$webhookHelper->addReplyMediaMessage($dataUsername,$RemoteJid,"sample.mp3","https://www.sample-videos.com/audio/mp3/crowd-cheering.mp3","[MP3]");
                                //$webhookHelper->addReplyMediaMessage($dataUsername,$RemoteJid,"sample.pdf","https://www.sample-videos.com/pdf/Sample-pdf-5mb.pdf","[PDF]");
                                //$webhookHelper->addReplyMediaMessage($dataUsername,$RemoteJid,"sample.mp4","https://www.sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4","[MP4]");                               
 
                                // Location Message
                                //$webhookHelper->addReplyLocationMessage($dataUsername,$RemoteJid,28.7041,77.1025);
                            }
                        }
                    }
                break;
                case 'image':
                    $mediaURL = $msgInfo['url'];
                    $mediaCaption = $msgInfo['caption'];
                    // Do Whatever you want
                break;
                case 'audio':
                    $mediaURL = $msgInfo['url'];
                    // Do Whatever you want
                break;
                case 'video':
                    $mediaURL = $msgInfo['url'];
                    $mediaCaption = $msgInfo['caption'];
                    // Do Whatever you want
                break;
                case 'document':
                    $mediaURL = $msgInfo['url'];
                    // Do Whatever you want
                break;
                                
            }
        break;

        case 'ack':
            $msgId = $dataContent['msgId'];
            $receiptTime = $dataContent['receiptTime'];
            if(!isset($dataContent['receiptType'])){
                $receiptType = 'Sent';
            } else {
                $receiptType = $dataContent['receiptType'];
            }
            // Message with $msgId is $receiptType at $receiptTime
            // Do Whatever you want
        break;

        case 'online':
            $isOnline = $dataContent['online'];
            $message = $dataContent['message'];
            // isOnline = 1 :: means Connected
            // isOnline = 0 :: means Not Connected, check message and take some action
        break;

        default:
        // Do Nothing
    }

header('Content-Type: application/json');
$webhookHelper->jsonResponse();
die();
?>