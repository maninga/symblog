<?php

namespace Blogger\BlogBundle\Twig\Extensions;

class BloggerBlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0)
            throw new \Exception("createdAgo is unable to handle dates in the future");

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = "il y a " . $time . " seconde" . (($time > 1) ? "s" : "");
        }
        else if ($delta <= 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration = "il y a " . $time . " minute" . (($time > 1) ? "s" : "");
        }
        else if ($delta <= 3600*24)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration = "il y a " . $time . " heure" . (($time > 1) ? "s" : "");
        }
        else if ($delta <= 3600*24*7)
        {
            // Days
            $time = floor($delta / (3600*24));
            $duration = "il y a " . $time . " jour" . (($time > 1) ? "s" : "");
        }

        else
        {
            // Weeks
            $time = floor($delta / (3600*24*7));
            $duration = "il y a " . $time . " semaine" . (($time > 1) ? "s" : "");
        }

        return $duration;
    }

    public function getName()
    {
        return 'blogger_blog_extension';
    }
}

