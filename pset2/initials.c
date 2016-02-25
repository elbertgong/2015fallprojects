#include <stdio.h>
#include <ctype.h>
#include <cs50.h>
#include <string.h>

int main(void)
{
    
    // Retrieves a string from the user
    string name = GetString();
    
    // Prints the first letter, capitalizing it if it's lowercase
    if (islower(name[0]))
    {
        printf("%c", toupper(name[0]));
    }
    else 
    {
        printf("%c", name[0]);
    }
    // Sets a for loop that will check for a space after each character
    for (int i = 0, n = strlen(name); i < n; i++)
    {
        if (isspace(name[i]))
        {
            
            // Prints letter, capitalizing if the letter is lowercase
            if (islower(name[i + 1]))
            {
                printf("%c", toupper(name[i + 1]));
            }
            else
            {
                printf("%c", name[i + 1]);
            }
        }    
    }
    printf("\n");
}
