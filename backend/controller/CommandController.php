<?php

class CommandController
{
    public function getAllCommands()
    {
        if(func_num_args() == 0)
        {
            //get all the commands. ADMIN TO USE
        }

        else if(func_num_args() == 1)
        {
            //check for userEmail correctness in the parameter
            //get all the commands OF THE USER'S EMAIL IN THE PARAMETER
        }

        else
        {
            //error code, number of arguments to large
        }
    }

    public function getDeliveredCommnds($userEmail)
    {
        if(func_num_args() == 0)
        {
            //get all the delivered commands. ADMIN TO USE
        }

        else if(func_num_args() == 1)
        {
            //check for userEmail correctness in the parameter
            //prepared statement FOR USER to get all the commands that have been delivered
        }

        else
        {
            //error code, number of arguments to large
        }

    }

    public function getOngoingCommands($userEmail)
    {
        if(func_num_args() == 0)
        {
            //get all the ongoing commands. ADMIN TO USE
        }

        else if(func_num_args() == 1)
        {
            //check for userEmail correctness in the parameter
            //prepared statement for USER to get all the commands that are ongoing
        }

        else
        {
            //error code, number of arguments to large
        }
    }

    public function addToShoppingCart($perfumeModel, $cost, $amount) :bool
    {

        return true;
    }

}