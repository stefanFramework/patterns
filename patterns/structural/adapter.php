<?php

// Clases
// =============================================================================
class Facebook {
    public function postToWall($msg) {
        echo "Publicado en tu Fb: " . $msg . "<br>";
    }
}

class Twitter {
    public function twit($content) {
        echo "Twiteando: " .$content . "<br>";
    }
}

// Adapters
// =============================================================================
interface SocialMediaAdapter {
    public function post($msg);
}

class FacebookAdapter implements SocialMediaAdapter {
    private $fb;
    
    public function __construct(Facebook $facebook) {
        $this->fb = $facebook;
    }
    
    public function post($message) {
        $this->fb->postToWall($message);
    }
}

class TwitterAdapter implements SocialMediaAdapter {
    private $twitter;
    
    public function __construct(Twitter $twitter) {
        $this->twitter = $twitter;
    }
    
    public function post($msg) {
        $this->twitter->twit($msg);
    }
}

// Use
// =============================================================================

$facebook = new FacebookAdapter(new Facebook());
$twitter = new TwitterAdapter(new Twitter());

$facebook->post("Hoy comi Fideos");
$twitter->post("Estoy enviando un Twit");



