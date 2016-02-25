/**
 * generate.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Generates pseudorandom numbers in [0,LIMIT), one per line.
 *
 * Usage: generate n [s]
 *
 * where n is number of pseudorandom numbers to print
 * and s is an optional seed
 */
 
#define _XOPEN_SOURCE

#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

// constant
#define LIMIT 65536

int main(int argc, string argv[])
{
    // Checks the number of command line arguments. If it isn't 2 or 3, 
    // print some error message and exit the program
    if (argc != 2 && argc != 3)
    {
        printf("Usage: generate n [s]\n");
        return 1;
    }

    // Stores the second command-line argument as an integer called n.
    int n = atoi(argv[1]);

    // If there are 3 command line arguments, turn the third command line
    // argument into an integer and set it as the seed of drand. If there aren't
    // 3 command line arguments, set the seed of drand as the current time.
    if (argc == 3)
    {
        srand48((long int) atoi(argv[2]));
    }
    else
    {
        srand48((long int) time(NULL));
    }

    // For "n" number of times, where n is the integer value of the second
    // command line argument, use the random number generator drand to generate
    // a floating point value between 0.0 and 1.0, multiply it by 65536, and
    // print it. Print each random number on a new line.
    for (int i = 0; i < n; i++)
    {
        printf("%i\n", (int) (drand48() * LIMIT));
    }

    // success
    return 0;
}