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
// echo "<p>".$ai->textGeneration('who is Tristan White?')->choices[0]->message->content."</p>";


// Chat Generation
// $chats = [
//     ["role" => "system", "content" => "You are a helpful assistant." ], 
//     ["role" => "user", "content" => "Who won the world series in 2020?" ], 
//     ["role" => "assistant", "content" => "The Los Angeles Dodgers won the World Series in 2020." ], 
//     ["role" => "user", "content" => "Where was it played?" ] 
// ];
// echo $ai->chatGeneration($chats)->choices[0]->message->content;


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
