<?php
namespace App\Controllers;

class Controller
{   
    public function init($parameters){}

    public function run($method_name)
    {
        header('Content-Type: application/json');
        $method = $method_name . 'Action';
        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], []);
        } else {
            $this->_setHeader(503);
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }
    
    public function release(){}

    public function profileAction()
    {
        $profile = [
            "name" => "Dan Faraday",
            "image_url" => "https://i.pravatar.cc/300?u=joselito",
            "location" => "Oxford, UK",
            "followers" => 100,
            "likes" => 200,
            "products" => 15,
            "about_me" => "Hi, I'm David a quantum enthusiast with a passion for unraveling the mysteries of the universe. Hat, glasses, and a curious mind!"
        ];
        
        echo json_encode($profile);
        die();
    } 

    public function timelineAction()
    {
        $timeline = [
            
                [
                    "image_url" => "https://i.pravatar.cc/300?u=joselito",
                    "name" => "Dan Faraday",
                    "time" => "25 min ago",
                    "description" => "Just delved into Stephen Hawking's 'The Elegant Design.' 📖🌌 Time, as Doctor Hawking beautifully puts it, is a concept that holds the universe together. 🕰️✨ Can't wait to explore the elegant intricacies of our cosmos! #StephenHawking #Time #CosmicWonders",
                    "likes" => 30,
                    "replies" => [
                        [
                            "image_url" => "https://i.pravatar.cc/300?u=megan_duncan",
                            "name" => "Megan Duncan",
                            "time" => "20 min ago",
                            "description" => "⏳💥 Ah, the enigmatic realm of time! A touch of Einstein's genius vibes. 😄 Curious minds might wonder if time travel is lurking in those equations. 🚀🕰️ Quantum debates loading! 🤓🎉 #EinsteinianEnigma #TimeFlies"
                        ],
                        [
                            "image_url" => "https://i.pravatar.cc/300?u=brandon",
                            "name" => "Brandon Smith",
                            "time" => "12 min ago",
                            "description" => "Indeed, Megan, the exploration of time is a profound endeavor. Hawking's work is a testament to human curiosity and the quest for understanding the universe's deepest secrets. #HawkingLegacy"
                        ],
                        [
                            "image_url" => "https://i.pravatar.cc/300?u=beverly",
                            "name" => "James Oliver",
                            "time" => "10 min ago",
                            "description" => "Ah, Megan, your enthusiasm is refreshing. Time is indeed a mind-boggling concept. I once had a remarkable discussion with Dr. Hawking about it. Feel free to reach out if you ever want to dive deeper into these quantum intricacies. #TimeWarp #PhysicsNerds"
                        ]
                    ]
                ],
                [
                    "image_url" => "https://i.pravatar.cc/300?u=joselito",
                    "name" => "Dan Faraday",
                    "time" => "42 min ago",
                    "description" => "The exchange of knowledge and ideas in our community is what makes the world of physics even more fascinating. Keep the debates coming, and let's continue exploring the mysteries of the universe together! 🌠✨ #QuantumTalks #Einstein #Hawking",
                    "likes" => 42,
                    "replies" => [
                        [
                            "image_url" => "https://i.pravatar.cc/300?u=louis",
                            "name" => "Louis Henry",
                            "time" => "2 min ago",
                            "description" => "No way! I dont understand how the knowledge and ideas in our community could help on our day to day tasks... or maybe I were mistake."
                        ]
                    ]
                ],
        ];
        
        echo json_encode($timeline);
        die();
    } 

    public function friendsAction()
    {
        $friends = ["https://i.pravatar.cc/300?u=rick", "https://i.pravatar.cc/300?u=morty", "https://i.pravatar.cc/300?u=beth","https://i.pravatar.cc/300?u=jerry", "https://i.pravatar.cc/300?u=summer", "https://i.pravatar.cc/300?u=joselito", "https://i.pravatar.cc/300?u=marisol", "https://i.pravatar.cc/300?u=marinieves", "https://i.pravatar.cc/300?u=alejandro"];
        echo json_encode($friends);
        die();
    } 
    
    public function photosAction()
    {
        $photos = ["https://i.pravatar.cc/300?u=ross", "https://i.pravatar.cc/300?u=monica", "https://i.pravatar.cc/300?u=joey","https://i.pravatar.cc/300?u=chandler","https://i.pravatar.cc/300?u=rachel", "https://i.pravatar.cc/300?u=phoebe"];
        echo json_encode($photos);
        die();
    } 
}