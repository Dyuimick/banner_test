<?php

namespace App;

class Tracker
{
    private DatabaseAdapterInterface $adapter;

    public function __construct(IDatabaseAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function save(BannerDTO $data): bool
    {
        $ipAddress = $data->getIpAddress();
        $userAgent = $data->getUserAgent();
        $pageUrl = $data->getPageUrl();
        $viewDate = $data->getViewDate();

        $sql = "INSERT INTO banner_views (ip_address, user_agent, view_date, page_url, views_count)
                VALUES ('$ipAddress', '$userAgent', '$viewDate', '$pageUrl', 1)
                ON DUPLICATE KEY UPDATE
                view_date = VALUES(view_date),
                views_count = views_count + 1;";

        return $this->adapter->query($sql) === TRUE;
    }
}





