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

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>OpenAI Api integration</h1>
    
    <h2>Text Generation</h2>
    <p>Generates a text response based on the given prompt using the specified parameters.</p>
    <p>API Documentation: <a href="https://platform.openai.com/docs/guides/text-generation">https://platform.openai.com/docs/guides/text-generation</a></p>
    
    <h3>Usage</h3>
    <p><code>$prompt</code> The prompt for generating the text response.</p>
    <p><code>$model</code> The gpt-3.5-turbo model to use for text generation. Available models: gpt-4, gpt-3.5-turbo.</p>
    <p><code>$temperature</code> The temperature parameter for controlling randomness (default: 0.7).</p>
    <p><code>$maxTokens</code> The maximum number of tokens in the generated text (default: 1000).</p>
    <p><strong>Result:</strong> An array containing 'data' and 'error' keys, representing the generated text and any errors.</p>

    <pre><code>&lt;?php echo $ai->textGeneration('Who is Tristan White?')->choices[0]->message->content; ?&gt;</code></pre>
    <pre><code>&lt;?php echo $ai->textGeneration('Who is Tristan White?','gpt-3.5-turbo')->choices[0]->message->content; ?&gt;</code></pre>
    
    <h3>Example</h3>
    <pre><code>&lt;?php echo "&lt;p&gt;".$ai->textGeneration('Who is tristan white?')->choices[0]->message->content."&lt;/p&gt;"; ?&gt;</code></pre>
    <?php
        // echo "<p>".$ai->textGeneration('who is Tristan White?')->choices[0]->message->content."</p>";
    ?>

    <hr>

    <h2>Image Generation</h2>
    <p>Generates an image based on the given prompt using the specified parameters.</p>
    <p>API Documentation: <a href="https://platform.openai.com/docs/guides/images/usage?context=node">https://platform.openai.com/docs/guides/images/usage?context=node</a></p>

    <h3>Usage</h3>
    <p><code>$prompt</code> The prompt for generating image.</p>
    <p><code>$size</code> The size of the generated image. Available size: 1024x1024, 1024x1792 or 1792x1024 pixels.</p>
    <p><code>$model</code> The dall-e-3 model to use for image generation. Available model: dall-e-3.</p>
    <p><strong>Result:</strong> An array containing 'data' and 'error' keys, representing the generated text and any errors.</p>
    <pre><code>&lt;?php $ai->imageGeneration('Draw Tristan White as a magnificent robot'); ?&gt;</code></pre>
    <pre><code>&lt;?php $ai->imageGeneration('Draw Tristan White as a magnificent robot','1024x1792'); ?&gt;</code></pre>
    <h3>Example</h3>
    <pre><code>&lt;?php 
    $image = $ai-&gt;imageGeneration(&#039;Draw Tristan White as a magnificent robot&#039;); 
    echo &#039;&lt;img src=&quot;&#039;.$image-&gt;data[0]-&gt;url.&#039;&quot; alt=&quot;&#039;.$image-&gt;data[0]-&gt;revised_prompt.&#039;&quot;&gt;&#039;;
?&gt;</code></pre>
    <?php 
        // $image = $ai->imageGeneration('Draw Tristan White as a magnificent robot'); 
        // echo '<img src="'.$image->data[0]->url.'" alt="'.$image->data[0]->revised_prompt.'">';
    ?>

    <hr>

    <h2>Text to Speech</h2>
    <p>Generates an audio file based on the given prompt using the specified parameters.</p>
    <p>API Documentation: <a href="https://platform.openai.com/docs/guides/text-to-speech">https://platform.openai.com/docs/guides/text-to-speech</a></p>
    
    <h3>Usage</h3>
    <p><code>$prompt</code> The prompt for generating the text to audio.</p>
    <p><code>$output</code> The absolute path to the about of the audio file. E.g. /path/to/my/audio.mp3</p>
    <p><code>$voice</code> The voice of the output. Available voices: alloy, echo, fable, onyx, nova, and shimmer.</p>
    <p><code>$model</code> The tts-1 model to use for text to audio translation. Available model: tts-1, tts-1-hd.</p>
    <p><strong>Result:</strong> file containing the audio data. The default response format is "mp3", but other formats like "opus", "aac", or "flac" are available.</p>
    
    <pre><code>$ai->textToSpeech('Who is Tristan White?','/path/to/my/audio.mp3');</code></pre>
    <pre><code>$ai->textToSpeech('Who is Tristan White?','/path/to/my/audio.mp3','onyx');</code></pre>

    <h3>Example</h3>
    <pre><code>&lt;?php
    $path = &quot;audio.mp3&quot;;
    $ai-&gt;textToSpeech(&#039;Who is Tristan White?&#039;,$path);
    echo &#039;&lt;audio autoplay&gt;&lt;source src=&quot;&#039;.$path.&#039;&quot; type=&quot;audio/mpeg&quot;&gt;&lt;/audio&gt;&#039;;
?&gt;
</code></pre>

    <?php
        // $path = "audio.mp3";
        // $ai->textToSpeech('Who is Tristan White?',$path);
        // echo '<audio autoplay><source src="'.$path.'" type="audio/mpeg"></audio>';
    ?>
</body>
</html>
