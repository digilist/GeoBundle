<?php
namespace Digilist\GeoBundle\ORM;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * DQL function for calculating distances between two points
 *
 * Example: DISTANCE(foo.point, :lat, :lng))
 */
class Distance extends FunctionNode
{

    const EARTH_RADIUS = 6371;

    /**
     * contains the database column
     * (distance is calculated between this and the given lat + lng attributes)
     *
     * @var \Doctrine\ORM\Query\AST\PathExpression
     */
    private $column;

    /**
     * lat coordinate
     *
     * @var \Doctrine\ORM\Query\AST\InputParameter
     */
    private $lat;

    /**
     * lng coordinate
     *
     * @var \Doctrine\ORM\Query\AST\InputParameter
     */
    private $lng;

    /**
     * generate the final sql query
     *
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        $distance = 'ABS(' . self::EARTH_RADIUS . ' * ACOS(ROUND(
                          COS(RADIANS(X(' . $this->column->dispatch($sqlWalker) . ')))
                        * COS(RADIANS(' . $this->lat->dispatch($sqlWalker) . '))
                        * COS(RADIANS(' . $this->lng->dispatch($sqlWalker) . ')
                                - RADIANS(Y(' . $this->column->dispatch($sqlWalker) . ')))
                        + SIN(RADIANS(X(' . $this->column->dispatch($sqlWalker) . ')))
                            * SIN(RADIANS(' . $this->lat->dispatch($sqlWalker) . '))
                    , 10)))';

        return $distance;
    }

    /**
     * parse the DISTANCE(column lat lng) function
     *
     * @param \Doctrine\ORM\Query\Parser $parser
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->column = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->lat = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->lng = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
