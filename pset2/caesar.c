#include <stdio.h>
#include <stdlib.h>
#include <cs50.h>
#include <string.h>

// Main accepts a command-line argument
int main(int argc, string argv[])
{
    // Checks that there are 2 command line arguments, or else exit program
    if (argc != 2)
    {
        printf("Don't do that\n");
        return 1;
    }
    
    else
    {
        // Turns the second argument into an integer mod 26
        int k = atoi(argv[1]) % 26;
        
        // Retrieves plaintext from user
        string p = GetString();
        
        // For-loop goes through every letter in the plaintext
        for (int i = 0, n = strlen(p); i < n; i++)
        {
            
            // Shifting every capital letter
            if (p[i] >= 65 && p[i] <= 90)
            {
                printf("%c", 65 + (p[i] - 65 + k) % 26);
            }
            
            // Shifting every lowercase letter
            else if (p[i] >= 97 && p[i] <= 122)
            {
                printf("%c", 97 + (p[i] - 97 + k) % 26);
            }
            
            // Printing out non-letter characters as they are
            else
            {
                printf("%c", p[i]);
            }
        }
        printf("\n");
        
        // Success!!
        return 0;
    }
}