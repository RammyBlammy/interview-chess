<?php

class Board
{
    private $figures = [];
    private $lastFigure = null;
    public function __construct()
    {
        $this->figures['a'][1] = new Rook($this, false);
        $this->figures['b'][1] = new Knight($this, false);
        $this->figures['c'][1] = new Bishop($this, false);
        $this->figures['d'][1] = new Queen($this, false);
        $this->figures['e'][1] = new King($this, false);
        $this->figures['f'][1] = new Bishop($this, false);
        $this->figures['g'][1] = new Knight($this, false);
        $this->figures['h'][1] = new Rook($this, false);

        $this->figures['a'][2] = new Pawn($this, false);
        $this->figures['b'][2] = new Pawn($this, false);
        $this->figures['c'][2] = new Pawn($this, false);
        $this->figures['d'][2] = new Pawn($this, false);
        $this->figures['e'][2] = new Pawn($this, false);
        $this->figures['f'][2] = new Pawn($this, false);
        $this->figures['g'][2] = new Pawn($this, false);
        $this->figures['h'][2] = new Pawn($this, false);

        $this->figures['a'][7] = new Pawn($this, true);
        $this->figures['b'][7] = new Pawn($this, true);
        $this->figures['c'][7] = new Pawn($this, true);
        $this->figures['d'][7] = new Pawn($this, true);
        $this->figures['e'][7] = new Pawn($this, true);
        $this->figures['f'][7] = new Pawn($this, true);
        $this->figures['g'][7] = new Pawn($this, true);
        $this->figures['h'][7] = new Pawn($this, true);

        $this->figures['a'][8] = new Rook($this, true);
        $this->figures['b'][8] = new Knight($this, true);
        $this->figures['c'][8] = new Bishop($this, true);
        $this->figures['d'][8] = new Queen($this, true);
        $this->figures['e'][8] = new King($this, true);
        $this->figures['f'][8] = new Bishop($this, true);
        $this->figures['g'][8] = new Knight($this, true);
        $this->figures['h'][8] = new Rook($this, true);
    }

    public function move($move)
    {
        if (!preg_match('/^([a-h])(\d)-([a-h])(\d)$/', $move, $match)) {
            throw new \Exception("Incorrect move");
        }

        $xFrom = $match[1];
        $yFrom = $match[2];
        $xTo   = $match[3];
        $yTo   = $match[4];

        // проверка на то, что координаты находятся внутри доски
        if ($yTo < 1 || $yTo > 8 || ord($xTo) < ord('a') || ord($xTo) > ord('h')) {
            throw new \Exception("Out of board on move: $move!");
        }

        if (isset($this->figures[$xFrom][$yFrom])) {

            if (isset($this->lastFigure) && $this->lastFigure->getColor() == $this->figures[$xFrom][$yFrom]->getColor()) {
                throw new \Exception("Incorrect color");
            }
            if (!$this->figures[$xFrom][$yFrom]->validateMove($xFrom, $yFrom, $xTo, $yTo)) {
                throw new \Exception("Cannot move like this: $move");
            }
            $this->figures[$xTo][$yTo] = $this->figures[$xFrom][$yFrom];
            $this->lastFigure = $this->figures[$xTo][$yTo];
        }
        unset($this->figures[$xFrom][$yFrom]);
    }

    public function dump()
    {
        for ($y = 8; $y >= 1; $y--) {
            echo "$y ";
            for ($x = 'a'; $x <= 'h'; $x++) {
                if (isset($this->figures[$x][$y])) {
                    echo $this->figures[$x][$y];
                } else {
                    echo '-';
                }
            }
            echo "\n";
        }
        echo "  abcdefgh\n";
    }

    /**
     * Получение фигуры по координатам на доске
     * 
     * @param string $x
     * @param int $y
     * 
     * @return Figure|null
     */
    public function getFigure(string $x, int $y): ?Figure
    {
        return $this->figures[$x][$y] ?? null;
    }
}
