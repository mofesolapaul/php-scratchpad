<?php declare(strict_types=1);

enum NumberType
{
    case EVEN;
    case ODD;
}

enum Operation
{
    case SQUARE;
    case NEGATE;
}

function makeFiber(): Fiber
{
    return new Fiber(function (int $number): void {
        /** @var Operation $whatToDo */
        $whatToDo = Fiber::suspend($number % 2 ? NumberType::ODD
            : NumberType::EVEN);

        $result = match ($whatToDo) {
            Operation::SQUARE => $number * $number,
            Operation::NEGATE => -$number,
        };

        echo "Result: $result\n";
    });
}

function runFiber(int $number)
{
    $fiber = makeFiber();

    /** @var NumberType $numberType */
    $numberType = $fiber->start($number);
    $operation = match ($numberType) {
        NumberType::EVEN => Operation::NEGATE,
        NumberType::ODD => Operation::SQUARE,
    };

    $fiber->resume($operation);
}

runFiber(4);
runFiber(5);
