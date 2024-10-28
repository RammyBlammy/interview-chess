<?php

class Pawn extends Figure
{
    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }

    public function validateMove(string $xFrom, int $yFrom, string $xTo, int $yTo): bool
    {
        // Количество клеток по вертикали, задействованных в ходе
        $stepsY = $this->isBlack ? $yFrom - $yTo : $yTo - $yFrom;
        // Количество клеток по горизонтали, задействованных в ходе 
        $stepsX = abs(ord($xTo) - ord($xFrom));
        if ($stepsX > 1) return false;

        // если ходим на одну клетку
        if ($stepsY == 1) {
            $figure = $this->board->getFigure($xTo, $yTo);
            // клетка свободна и движение не по диагонали
            if ($stepsX == 0 && $figure === null) {
                return true;
            }
            // клетка не свободна и движение по диагонали на противника
            if ($stepsX == 1 && $figure !== null && $figure->getColor() != $this->isBlack) {
                return true;
            }
        } elseif ($stepsY == 2 && $yFrom == ($this->isBlack ? 7 : 2) && $stepsX == 0) { // движение из изначального положения на 2 кл.
            $targetCell = $this->board->getFigure($xTo, $yTo);
            $prevTargetCell = $this->board->getFigure($xTo, $yTo + (1 * $this->isBlack ? 1 : -1));
            if ($targetCell === null && $prevTargetCell === null) {
                return true;
            }
        }
        // TODO добавить взятие на проходе
        return false;
    }
}
