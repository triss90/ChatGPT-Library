<?php
class ChatGPT
{
    // Your OpenAI API Key (Replace with your key)
    // https://platform.openai.com/api-keys
    private $API_KEY = "sk-b5gJR6xL43lDc...";

    // OpenAI API Endpoints
    private $API_ENDPOINT_TEXT_GENERATION = "https://api.openai.com/v1/chat/completions";
    private $API_ENDPOINT_IMAGE_GENERATION = "https://api.openai.com/v1/images/generations";
    private $API_ENDPOINT_TEXT_TO_SPEECH = "https://api.openai.com/v1/audio/speech";

    public $curl;


    /**
     * Initialize curl
     */
    public function __construct()
    {
        $this->curl = curl_init();
    }


    /**
     * Initialize the curl request headers and set endpoints appropriately
     */
    public function initialize($type)
    {
        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$this->API_KEY;
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_POST, 1);

        $url = match($type) {
            'text' => $this->API_ENDPOINT_TEXT_GENERATION,
            'audio' => $this->API_ENDPOINT_TEXT_TO_SPEECH,
            'image' => $this->API_ENDPOINT_IMAGE_GENERATION,
            default => throw new Exception("Invalid type provided")
        };

        curl_setopt($this->curl, CURLOPT_URL, $url);
    }


    /**
     * Generates a text response based on the given prompt using the specified parameters.
     *
     * @param string/array $prompt The prompt for generating the text response. Either a string witha single prompt og an array of prompts
     * @param string $model The gpt-3.5-turbo model to use for text generation. Available models: gpt-4, gpt-3.5-turbo.
     * @param float $temperature The temperature parameter for controlling randomness (default: 0.7).
     * @param int $maxTokens The maximum number of tokens in the generated text (default: 1000).
     * @return array An array containing 'data' and 'error' keys, representing the generated text and any errors.
     * 
     * API Documentation: https://platform.openai.com/docs/guides/text-generation
     * 
     * Example usage
     * $chats = [
     *   ["role" => "system", "content" => "You are a helpful assistant." ], 
     *   ["role" => "user", "content" => "Who won the world series in 2020?" ], 
     *   ["role" => "assistant", "content" => "The Los Angeles Dodgers won the World Series in 2020." ], 
     *   ["role" => "user", "content" => "Where was it played?" ] 
     * ];
     * $chat = 'Who is Tristan White?'
     * echo $ai->textGeneration($chats)->choices[0]->message->content;
     * echo $ai->textGeneration($chat,'gpt-3.5-turbo')->choices[0]->message->content;
     */
    public function textGeneration($prompt, $model = 'gpt-4', $temperature = 0.7, $maxTokens = 1000)
    {
        $this->initialize('text');

        if(!is_array($prompt)) {
            $promptArr = [
                [
                    "role" => "user",
                    "content" => $prompt
                ]
            ];
        } else {
            $promptArr = $prompt;
        }
        
        // Define the data
        $data = [
            "model" => $model,
            "messages" => $promptArr,
            "temperature" => $temperature,
            "max_tokens" => $maxTokens,
            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            "stop" => ["11."],
        ];
        
        // Make the curl request
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($this->curl);
        if (curl_errno($this->curl)) {
            echo 'Error:' . curl_error($this->curl);
        }
        curl_close($this->curl);
        $response = json_decode($response);

        // Return the AI response
        return $response;
    }

    
    /**
     * Generates an audio file based on the given prompt using the specified parameters.
     *
     * @param string $prompt The prompt for generating the text to audio.
     * @param string $output The absolute path to the about of the audio file. E.g. /path/to/my/audio.mp3
     * @param string $voice The voice of the output. Available voices: alloy, echo, fable, onyx, nova, and shimmer.
     * @param string $model The tts-1 model to use for text to audio translation. Available model: tts-1, tts-1-hd.
     * @return array file containing the audio data. The default response format is "mp3", but other formats like "opus", "aac", or "flac" are available.
     * 
     * API Documentation: https://platform.openai.com/docs/guides/text-to-speech
     * 
     * Example usage
     * $ai->textToSpeech('Who is Tristan White?','/path/to/my/audio.mp3');
     * $ai->textToSpeech('Who is Tristan White?','/path/to/my/audio.mp3','onyx');
     */
    public function textToSpeech($prompt, $output, $voice = 'fable', $model = 'tts-1')
    {
        $this->initialize('audio');

        // Define the data
        $data = [
            "model" => $model,
            "input" => $prompt,
            "voice" => $voice
        ];

        // Make the curl request
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($this->curl);
        if (curl_errno($this->curl)) {
            echo 'Error:' . curl_error($this->curl);
        }
        curl_close($this->curl);

        
        // Create directory if it doesn't exist
        $directory = dirname($output);
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                throw new Exception("Unable to create the directory: $directory");
            }
        }

        // Write the output to a file
        if (file_put_contents($output, $response) === false) {
            throw new Exception("Failed to write the audio file to: $output");
        }
      
        
        // Return the AI response
        return $response;

    }

    /**
     * Generates an image based on the given prompt using the specified parameters.
     *
     * @param string $prompt The prompt for generating image.
     * @param string $size The size of the generated image. Available size: 1024x1024, 1024x1792 or 1792x1024 pixels.
     * @param string $model The dall-e-3 model to use for image generation. Available model: dall-e-3.
     * @return array An array containing 'data' and 'error' keys, representing the generated text and any errors.
     * 
     * API Documentation: https://platform.openai.com/docs/guides/images/usage?context=node
     * 
     * Example usage
     * $ai->imageGeneration('Draw Tristan White as a magnificent robot');
     * $ai->imageGeneration('Draw Tristan White as a magnificent robot','1024x1792');
     */
    public function imageGeneration($prompt, $size = '1024x1024', $model = 'dall-e-3')
    {
        $this->initialize('image');

        // Define the data
        $data = [
            "model" => $model,
            "prompt" => $prompt,
            "n" => 1,
            "size" => $size
        ];

        // Make the curl request
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($this->curl);
        if (curl_errno($this->curl)) {
            echo 'Error:' . curl_error($this->curl);
        }
        curl_close($this->curl);
        $response = json_decode($response);

        // Return the AI response
        return $response;
    }
	
}