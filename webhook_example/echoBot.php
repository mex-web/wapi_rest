<?PHP
include 'class.webhookHelper.php';
$webhookHelper = new webhookHelper();

    $data = json_decode(file_get_contents('php://input'), true);
    $dummyTimestamp = 1556475713; // Dummy :: Sun, 28 Apr 2019 18:21:53 GMT
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
                            $webhookHelper->addReplyTextMessage($dataUsername,$RemoteJid,"[echo] ".$messageText);
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