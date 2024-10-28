<?php

class Figure
{
    protected $isBlack;
    protected Board $board;

    public function __construct(Board $board, $isBlack)
    {
        $this->isBlack = $isBlack;
        $this->board = $board;
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString()
    {
        throw new \Exception("Not implemented");
    }

    public function getColor()
    {
        return $this->isBlack;
    }

    /**
     * Проверка на корректность хода фигурой
     * 
     * @param string $xFrom координата х текущей клетки
     * @param int $yFrom координата y текущей клетки
     * @param string $xTo координата х конечной клетки
     * @param int $yTo координата у конечной клетки
     * 
     * @return bool корректен ли ход
     */
    public function validateMove(string $xFrom, int $yFrom, string $xTo, int $yTo): bool
    {
        return true;
    }
}
