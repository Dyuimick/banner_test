<?php

namespace App;

class Tracker
{
    private IDatabaseAdapter $adapter;

    public function __construct(IDatabaseAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function save(BannerDTO $bannerDTO): array
    {
        $sql = "INSERT INTO tracker (view_date, user_agent,  page_url, ip_address, views_count) 
VALUES (:view_date, :user_agent, :page_url, :ip_address, 1)
 ON CONFLICT (view_date, user_agent, page_url, ip_address) DO 
UPDATE SET views_count = views_count + 1;";
        $params = [
            ':ip_address' => $bannerDTO->getIpAddress(),
            ':user_agent' => $bannerDTO->getUserAgent(),
            ':view_date' => $bannerDTO->getViewDate(),
            ':page_url' => $bannerDTO->getPageUrl(),
        ];

        return $this->adapter->query($sql, $params);
    }
}





