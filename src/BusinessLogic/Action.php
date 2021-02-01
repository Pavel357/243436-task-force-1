<?php

namespace Taskforce\BusinessLogic;

abstract class Action
{
    abstract function getNameAction();
    abstract function getInsideAction();
    abstract function isCompareID($currentID, $executorID, $customerID);
}