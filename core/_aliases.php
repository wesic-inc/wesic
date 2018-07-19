<?php

/**
 * Fetch theme env from singleton
 * @return [type] [description]
 */
function themeEnv()
{
    return Singleton::theme();
}

/**
 * Print data for debug
 * @param  [type]  $a [description]
 * @param  integer $b [description]
 * @param  integer $c [description]
 * @return [type]     [description]
 */
function dump($a, $b = 0, $c = 1)
{
    Format::dump($a, $b, $c);
}
/**
 * Alias for dump, dump and die
 * @param  [type]  $a [description]
 * @param  integer $c [description]
 * @return [type]     [description]
 */
function dd($a, $c = 1)
{
    Format::dump($a, 1, $c);
}

/**
 * Alias for request singleton
 */
function Req()
{
    return Singleton::request();
}

/**
 * Allow to get a setting by key, fetching from setting singleton
 * @param  [type] $key [description]
 * @return [type]      [description]
 */
function setting($key)
{
    return Singleton::settings()[$key][2];
}

/**
 * Print script in template, based on the theme conf
 * @return [type] [description]
 */
function get_scripts()
{
    echo '<script type="text/javascript" src="/public/js/jquery.min.js"></script>';

    foreach (themeEnv()['javascript'] as $value) {
        echo '<script type="text/javascript" src="/themes/'.setting('theme').'/assets/'.$value.'"></script>';
    }
}

/**
 * Print stylesheet in template, based on the theme conf
 * @return [type] [description]
 */
function get_css()
{
    echo '<link rel="stylesheet" href="/public/icomoon/style.css">';
    foreach (themeEnv()['style'] as $value) {
        echo '<link rel="stylesheet" type="text/css" href="/themes/'.setting('theme').'/assets/'.$value.'">';
    }
}

/**
 * Print the favicon, based on setings
 * @return [type] [description]
 */
function the_favicon()
{
    echo '<link rel="icon" type="image/png" href="'.ROOT_URL.setting("favicon").'" />';
}

/**
 * Print the title in meta title, based on settings
 * @param  [type] $title [description]
 * @return [type]        [description]
 */
function the_sitename($title = null)
{
    echo '<title>'.isset($title)?$title:setting('title').'</title>';
}

/**
 * Print the meta description, based on controller parameters
 * @param  [type] $description [description]
 * @return [type]              [description]
 */
function seo_description($description = null)
{
    echo '<meta name="description" content="'.isset($description)?$description:"Mon site Wesic".'">';
}

/**
 * Include admin bar when user is connected
 * @return [type] [description]
 */
function admin_bar()
{
    if (Auth::isConnected()) {
        include "views/modals/admin-navbar.mdl.php";
    }
}

/**
 * Include the navbar template
 * @return [type] [description]
 */
function the_navbar()
{
    include('themes/'.setting('theme').'/views/templates/navbar.php');
}

/**
 * Print the article featured image
 * @param  [type] $class [description]
 * @return [type]        [description]
 */
function article_featured($class = null)
{
    if (isset(Singleton::bridge()['article']['path'])) {
        echo '<img src="'.Singleton::bridge()['article']['path'].'">';
    }
}

/**
 * Print the article tile
 * @return [type] [description]
 */
function article_title()
{
    echo Singleton::bridge()['article']['title'];
}

/**
 * Print the article content
 * @return [type] [description]
 */
function article_content()
{
    echo Singleton::bridge()['article']['content'];
}

/**
 * Print the article date, format depending on settings
 * @return [type] [description]
 */
function article_date()
{
    echo Format::humanTime(Singleton::bridge()['article']['date']);
}

/**
 * Include comments modal
 * @return [type] [description]
 */
function the_comments()
{
    return Singleton::bridge()['path'];
}

/**
 * Include the current view to templat
 * @return [type] [description]
 */
function the_view()
{
    include Singleton::bridge()['view'];
}


function get_articles($nb = 5, $column = ['title'=>"h1",'category'=>"p",'tags'=>"li",'date'=>"p",'excerpt'=>"div",'featured'=>""], $wrapperClass = "col-md-4")
{
    $select = [];
    $leftJoin = [];
    $selectStr = "";

    foreach ($column as $key => $value) {
        switch ($key) {
            case 'title':
            $select[] = 'p.title';
            break;
            case 'date':
            $select[] = 'p.published_at as date';
            break;
            case 'excerpt':
            $select[] = 'p.excerpt';
            break;
            case 'content':
            $select[] = 'p.content';
            break;
            case 'featured':
            $select[] = 'media.path as featured';
            $leftJoin['media'] = 'media.id = p.featured';
            break;
            default:
            break;
        }
    }
    $qb = new QueryBuilder();

    for ($i=0;$i<count($select);$i++) {
        $selectStr .= $select[$i];
        if ($i < count($select)-1) {
            $selectStr .= ',';
        }
    }


    $qb->select('p.id, p.slug, '.$selectStr)
    ->from('post as p');
    foreach ($leftJoin as $key => $value) {
        $qb->leftJoin($key, $value);
    }
    $articles =
    $qb->where('p.type', 1)
    ->and()
    ->where('p.published_at', '<=', date('Y-m-d H:i:s'))
    ->and()
    ->where('p.status', 1)
    ->orderBy('p.published_at', 'DESC')
    ->limit(0, $nb)
    ->get();

    foreach ($articles as $article) {
        echo '<div class="'.$wrapperClass.'">';
        foreach ($column as $key => $html) {
            if ($key == 'title' && isset($article['title'])) {
                echo '<'.$html.' class="article-title"><a href="'.$article['slug'].'">'.$article['title'].'</a></'.$html.'>';
            }
            if ($key == 'date' && isset($article['date'])) {
                echo '<'.$html.' class="article-title">'.$article['date'].'</'.$html.'>';
            }
            if ($key == 'featured' && isset($article['featured'])) {
                echo '<img class="article-featured" src="'.$article['featured'].'">';
            }
            if ($key == 'category' && isset($article['id'])) {
                $cat = Category::getCategory($article['id']);
                echo '<a href="'.$cat['slug'].'">'.$cat['label'].'</a>';
            }
            if ($key == 'tags' && isset($article['tags'])) {
                $cat = Category::getCategory($article['id']);
                echo '<'.$html.'><a href="'.$cat['slug'].'">'.$cat['label'].'</a></'.$html.'>';
            }
            if ($key == 'excerpt' && isset($article['excerpt'])) {
                echo '<'.$html.'>'.$article['excerpt'].'</'.$html.'>';
            }
            if ($key == 'content' && isset($article['content'])) {
                echo '<'.$html.' class="article-content">'.$article['content'].'</'.$html.'>';
            }
        }
        echo '</div>';
    }
}

function get_articles_array($limit = 10, $content = false)
{
    $qb = new QueryBuilder();
        
    return $qb->select('p.title,p.excerptp.slug,p.published_at as date,media.path as img')
        ->from('post as p')
        ->leftJoin('media', 'media.id = p.featured')
        ->where('p.type', 1)
        ->and()
        ->where('p.published_at', '<=', date('Y-m-d H:i:s'))
        ->and()
        ->where('p.status', 1)
        ->orderBy('p.published_at', 'DESC')
        ->limit(0, $limit)
        ->get();
}

function get_medias($type = 1, $limit= 10, $paginated = false, $perPage = 10, $wrapper ="col-md-4")
{
    

}
