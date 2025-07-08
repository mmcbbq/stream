<?php
$api = htmlspecialchars('http://'.$_ENV['CANDIDATE'].':1985/rtc/v1/play/');
$stream = htmlspecialchars('webrtc://'.$_ENV['CANDIDATE'].'/live/livestream');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SRS WebRTC Stream</title>
</head>
<body>


<h1>Live WebRTC Stream</h1>
<video id="webrtc-video" autoplay playsinline controls muted width="640" height="360"></video>

<script>
    async function playStream() {
        const video = document.getElementById('webrtc-video');

        const apiUrl = '<?php echo $api ?>';
        const streamUrl = '<?php echo $stream ?>';

        const req = {
            api: apiUrl,
            streamurl: streamUrl,
            clientip: null,
            sdp: null
        };

        const pc = new RTCPeerConnection(null);

        pc.ontrack = function (event) {
            video.srcObject = event.streams[0];
        };

        const offer = await pc.createOffer({
            offerToReceiveAudio: true,
            offerToReceiveVideo: true
        });
        await pc.setLocalDescription(offer);

        req.sdp = offer.sdp;

        const response = await fetch(apiUrl, {
            method: 'POST',
            body: JSON.stringify(req)
        });

        const data = await response.json();
        await pc.setRemoteDescription(new RTCSessionDescription({ type: 'answer', sdp: data.sdp }));
    }

    playStream();
</script>
</body>
</html>