<?php
require ("chatgpt.php");
$ai = new ChatGPT;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenAI Api integration</title>
</head>
<body>
<pre>

<?php
// Text Generation
// $chats = [
//     ["role" => "system", "content" => "You are a helpful assistant." ], 
//     ["role" => "user", "content" => "Who won the world series in 2020?" ], 
//     ["role" => "assistant", "content" => "The Los Angeles Dodgers won the World Series in 2020." ], 
//     ["role" => "user", "content" => "Where was it played?" ] 
// ];
// $chat = 'who is Tristan White?';
// echo "<p>".$ai->textGeneration($chat)->choices[0]->message->content."</p>";
// echo "<p>".$ai->textGeneration($chats)->choices[0]->message->content."</p>";


// Image Generation
// $image = $ai->imageGeneration('Draw Tristan White as a magnificent robot'); 
// echo '<img src="'.$image->data[0]->url.'" alt="'.$image->data[0]->revised_prompt.'">';


// Text to Speech
// $path = "audio.mp3";
// $ai->textToSpeech('Who is Tristan White?',$path);
// echo '<audio autoplay controls><source src="'.$path.'" type="audio/mpeg"></audio>';
?>

</pre>
</body>
</html>
