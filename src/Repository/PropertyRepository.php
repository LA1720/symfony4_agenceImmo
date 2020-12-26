<?php

namespace App\Repository;



use App\Entity\Property;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * 
     * @return Property[]
     */

    public function findAllVisible(): array // here :array means the result should be in array type
        {
            return $this->findVisibleQuery() //This private function findVisibleQuery replaced these 2 lines in comments!!
                    // -> createQueryBuilder('p')
                    // ->where('p.sold = false')
                   ->getQuery() 
                   ->getResult();
        }  
//now go back to our PropertyController and use this findAllVisible() method in index() exm..
// $property = $this->repository->findAllVisible(); and add (ObjectManager $em) in __construct and
//check with dump($property);

    /**
     * @return Property[] 
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery() //This private function findVisibleQuery replaced these 2 lines in comments!!
                    // -> createQueryBuilder('p')
                    // ->where('p.sold = false')
                    ->setMaxResults(4) // to show 4 annonces by page
                    ->getQuery()//
                    ->getResult();
    }//now let's back to HomeController and make the ->render view in index with this function!! 






    /**
     * @return QueryBuilder
     */
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
                    ->where('p.sold = false');
    }
    //this private function findVisibleQuery() will replace those 2 lines in comments (-> createQueryBuilder('p') and ->where('p.sold = false'))!!
    



    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}