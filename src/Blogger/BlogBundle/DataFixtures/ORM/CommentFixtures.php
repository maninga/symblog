<?php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Entity\Blog;

class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
   public function curl($url,$params = array(),$is_coockie_set = false)
    {

        if(!$is_coockie_set){
            /* STEP 1. let’s create a cookie file */
            $ckfile = tempnam ("/tmp", "CURLCOOKIE");

            /* STEP 2. visit the homepage to set the cookie properly */
            $ch = curl_init ($url);
            curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec ($ch);
        }

        $str = ''; $str_arr= array();
        foreach($params as $key => $value)
        {
            $str_arr[] = urlencode($key)."=".urlencode($value);
        }
        if(!empty($str_arr))
            $str = '?'.implode('&',$str_arr);

        /* STEP 3. visit cookiepage.php */

        $Url = $url.$str;

        $ch = curl_init ($Url);
        curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec ($ch);
        return $output;
    }

    public function Translate($word,$conversion = 'en_to_fr')
    {
        $word = urlencode($word);

        // english to french
        if($conversion == 'en_to_fr')
            $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=en&tl=fr&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';

        // dutch to english
        if($conversion == 'nl_to_en')
            $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

        // hindi to english
        if($conversion == 'hi_to_en')
            $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=hi&tl=en&ie=UTF-8&oe=UTF-8&multires=1&otf=1&pc=1&trs=1&ssel=3&tsel=6&sc=1';

        //$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

        $name_en = $this->curl($url);

        $name_en = explode('"',$name_en);
        return  $name_en[1];
    }

    public function load(ObjectManager $manager)
    {

        $comment = new Comment();
        $comment_en = 'To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('symfony');
        $comment->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('David');
        $comment->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Dade');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Are you challenging me?';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Kate');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:15:20"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Name your stakes.';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Dade');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:18:35"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'If I win, you become my slave.';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Kate');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:22:53"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Your SLAVE?';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Dade');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:25:15"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'You wish! You\'ll do shitwork, scan, crack copyrights...';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Kate');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:46:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'And if I win?';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Dade');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-23 10:22:46"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Make it my first-born!';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Kate');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-23 11:08:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Make it our first-date!';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Dade');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-24 18:56:01"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment_en = 'I don\'t DO dates. But I don\'t lose either, so you\'re on!';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $comment->setCreated(new \DateTime("2011-07-25 22:28:42"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'It\'s not gonna end like this.';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Stanley');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Gabriel');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Doesn\'t Bill Gates have something like that?';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Mile');
        $comment->setBlog($manager->merge($this->getReference('blog-5')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment_en = 'Bill Who?';
        $comment_fr = $this->Translate($comment_en, "en_to_fr");
	$comment->setComment( $comment_fr !== null ? $comment_fr : $comment_en);
        $comment->setUser('Gary');
        $comment->setBlog($manager->merge($this->getReference('blog-5')));
        $manager->persist($comment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}

