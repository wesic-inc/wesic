<?php 
class SlugRepository extends Basesql{

    public static function getSlugTable(){

        $qb = new QueryBuilder();
        $slugDb = $qb->findAll('slug')->execute();


        $slugPartial = [];

        foreach ($slugDb as $value) {
            array_push($slugPartial, $value['slug']);
        }
        
        return array_merge( $slugPartial,Route::allRouteSlug());

    }   

    public static function slugExistsWithId($slug,$id){


        if(Basesql::slugExists($slug)){

        $qb = new QueryBuilder();
        $slugDb = 
        $qb->findAll('slug')
        ->addWhere('slug = :slug')
        ->setParameter('slug',$slug)
        ->fetchOne();

        $qb->reset();

        switch ($slugDb['type']) {
            case 1:
                $qb->findAll('post');
            break;
            case 2:
                $qb->findAll('post');
            break;
            case 3:
                $qb->findAll('category');
            break;
            default:
                unset($qb);
            break;
        }

        if(isset($qb)){

            $element = $qb->addWhere('slug = :slug')->setParameter('slug',$slug)->fetchOne();

            if($element['id'] == $id){
                return false;
            }else{
                return true;
            }
        }

        }


    }

}
