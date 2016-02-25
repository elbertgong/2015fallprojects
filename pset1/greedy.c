#include <stdio.h>
#include <cs50.h>
#include <math.h>
int main(void)
{
    float money;
    
    // Retrieves an acceptable money amount using do-while loop
    do 
    {
        printf("O hai! How much change is owed? ");
        money = GetFloat();
    }
    while(money < 0);
    
    // Rounds money amount to an integer
    int cents = round(money * 100);
    int coins = 0;
    
    // Deducts max number of quarters from money amount
    while (cents >= 25)
    {
        coins++;
        cents -= 25;
    }
        
    // Deducts max number of dimes from money amount
    while (cents >= 10)
    {
        coins++;
        cents -= 10;
    }
        
    // Deducts max number of nickels from money amount
    while (cents >= 5)
    {
        coins++;
        cents -= 5;
    }
        
    // Deducts max number of pennies from money amount
    while (cents >= 1)
    {
        coins++;
        cents -= 1;
    }
    printf("%i\n", coins);
}    