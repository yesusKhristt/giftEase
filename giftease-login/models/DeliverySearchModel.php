<?php

class DeliverySearchModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($keyword, $page)
    {
        // Page content for delivery dashboard
        $pageContent = [
            'Welcome Back, Saneth!',
            'Ready to make some deliveries today',
            'Today\'s Overview',
            'Orders Assigned',
            'Delivered Today',
            'Pending Deliveries',
            'Success Rate',
            'Today\'s Deliveries',
            'Today\'s Earnings',
            'Rating',
            'Distance Covered',
            'Home',
            'Order',
            'Map',
            'History',
            'Notification',
            'Proof',
            '3',
            '1',
            '2',
            '95%',
            '8',
            '$127',
            '4.9',
            '45km'
        ];

        // Search through page content
        $results = [];
        $keyword_lower = strtolower($keyword);
        
        foreach ($pageContent as $content) {
            if (stripos($content, $keyword) !== false) {
                $results[] = [
                    'text' => $content,
                    'type' => 'page_content'
                ];
            }
        }

        return $results;
    }
}
