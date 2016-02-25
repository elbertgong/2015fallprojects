/**
 * Elbert Gong CS50 Fall 2015
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       
#include <cs50.h>

#include "helpers.h"

/**
 * Returns true if value is in array of n values, else false.
 */

bool search(int value, int values[], int n)
{
    
    // checks for positivity
    if (n <= 0)
    {
        return false;
    }
    else
    {
        
        // sets a bottom and top boundary in preparation for binary search
        int bottom = 0;
        int top = n - 1;
        
        // if the boundaries overlap, the program knows to stop and return false
        while (bottom <= top)
        {
            int midpoint = (bottom + top) / 2;
            
            // if you've found the value
            if (value == values[midpoint])
            {
                return true;
            }
            
            // if the value is to the left of your midpoint
            else if (value < values[midpoint])
            {
                top = midpoint - 1;
            }
            
            // if the value is to the right of your midpoint
            else if (value > values[midpoint])
            {
                bottom = midpoint + 1;
            }
        }
        
        // if value was not found
        return false;
    }
}

/**
 * Sorts array of n values.
 */
void sort(int values[], int n)
{
    int min;
    
    // each iteration of searching for the minimum starts one position over
    for (int i = 0; i < n - 1; i++)
    {
        min = i;
       
        // goes through the list searching for a minimum
        for (int j = i + 1; j < n; j++)
        {
            if (values[j] < values[min])
            {
                
                // records position of the minimum
                min = j;
            } 
        }
        if (min != i)
        {
           
            // performs the swap if i isn't the minimum
            int temporary = values[i];
            values[i] = values[min];
            values[min] = temporary;
        }
    }
    return;
}