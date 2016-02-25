#include <stdio.h>
#include <cs50.h>

int main(void)
{
    printf("minutes:");
    
    // Retrieves a number of minutes showered
    int minutes = GetInt();
    
    // Prints number of bottles
    printf("bottles: %i\n", minutes * 12);
    

}