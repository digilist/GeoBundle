This bundle provides a simple integration for the MySQL POINT-Datatype and some distance calculations.

Please note: This bundle is at an early stage of development, use it at your own risk!

## Installation
Please install this bundle via composer (via a custom repository) and add the following options into your config.yml:

```
doctrine:
        types:
            point: Digilist\GeoBundle\ORM\PointType
        mapping_types:
            point: point

    orm:
        dql:
            numeric_functions:
                DISTANCE: Digilist\GeoBundle\ORM\Distance
```

## Usage
After installation, you can now use the new `POINT` Datatype within your entity definitions.

```
/**
 * @Column(type="point")
 */
private $coordinates;
```

Distance Calculation (you can use the DISTANCE function anywhere in the query builder or in your DQL function):

```
// Query Builder
$qb = $this->getEntityManager()->createQueryBuilder();
$qb->from('Company', 'c')
   ->where('DISTANCE(c.coordinates, :lat, :lng) < 20')
   ->setParameter('lat', $point->getLatitude())
   ->setParameter('lng', $point->getLongitude());
```
