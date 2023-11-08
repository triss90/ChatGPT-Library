# OpenAI Api integration

## Text Generation

Generates a text response based on the given prompt using the specified parameters.

API Documentation: [https://platform.openai.com/docs/guides/text-generation](https://platform.openai.com/docs/guides/text-generation)

### Usage

`$prompt` The prompt for generating the text response.

`$model` The gpt-3.5-turbo model to use for text generation. Available models: gpt-4, gpt-3.5-turbo.

`$temperature` The temperature parameter for controlling randomness (default: 0.7).

`$maxTokens` The maximum number of tokens in the generated text (default: 1000).

**Result:** An array containing 'data' and 'error' keys, representing the generated text and any errors.

```php
<?php 
    echo $ai->textGeneration('Who is Tristan White?')->choices[0]->message->content; 
    echo $ai->textGeneration('Who is Tristan White?','gpt-3.5-turbo')->choices[0]->message->content; 
?>
```


### Example

```php
<?php 
    echo "<p>".$ai->textGeneration('Who is tristan white?')->choices[0]->message->content."</p>"; 
?>
```

## Image Generation

Generates an image based on the given prompt using the specified parameters.

API Documentation: [https://platform.openai.com/docs/guides/images/usage?context=node](https://platform.openai.com/docs/guides/images/usage?context=node)

### Usage

`$prompt` The prompt for generating image.

`$size` The size of the generated image. Available size: 1024x1024, 1024x1792 or 1792x1024 pixels.

`$model` The dall-e-3 model to use for image generation. Available model: dall-e-3.

**Result:** An array containing 'data' and 'error' keys, representing the generated text and any errors.

```php
<?php 
    $ai->imageGeneration('Draw Tristan White as a magnificent robot'); 
    $ai->imageGeneration('Draw Tristan White as a magnificent robot','1024x1792');
?>
```

### Example

```php
<?php 
    $image = $ai->imageGeneration('Draw Tristan White as a magnificent robot'); 
    echo '<img src="'.$image->data[0]->url.'" alt="'.$image->data[0]->revised_prompt.'">';
?>
```

## Text to Speech

Generates an audio file based on the given prompt using the specified parameters.

API Documentation: [https://platform.openai.com/docs/guides/text-to-speech](https://platform.openai.com/docs/guides/text-to-speech)

### Usage

`$prompt` The prompt for generating the text to audio.

`$output` The absolute path to the about of the audio file. E.g. /path/to/my/audio.mp3

`$voice` The voice of the output. Available voices: alloy, echo, fable, onyx, nova, and shimmer.

`$model` The tts-1 model to use for text to audio translation. Available model: tts-1, tts-1-hd.

**Result:** file containing the audio data. The default response format is "mp3"

```php
<?php 
    $ai->textToSpeech('Who is Tristan White?','/path/to/my/audio.mp3');
    $ai->textToSpeech('Who is Tristan White?','/path/to/my/audio.mp3','onyx');
?>
```

### Example
```php
<?php
    $path = "audio.mp3";
    $ai->textToSpeech('Who is Tristan White?',$path);
    echo '<audio autoplay><source src="'.$path.'" type="audio/mpeg"></audio>';
?>
```
