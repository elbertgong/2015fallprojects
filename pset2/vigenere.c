#include <stdio.h>
#include <string.h>
#include <cs50.h>

// Main accepts a command-line argument
int main(int argc, string argv[])
{
    
    // Checks that there are 2 command-line arguments, or else exit program
    if (argc != 2)
    {
        printf("Don't do that!\n");
        return 1;
    }

    else
    {
        
        // An array called "key" will contain the keyword converted into numbers
        int key[strlen(argv[1]) - 1];
        for (int x = 0, n = strlen(argv[1]); x < n; x++)
        {
            
            // It'll turn a capital A into 0, capital B into 1, and so on
            if (argv[1][x] >= 65 && argv[1][x] <= 90)
            {
                key[x] = argv[1][x] - 65;
            }
            
            // It'll turn a lowercase a into 0, lowercase b into 1, and so on
            else if (argv[1][x] >= 97 && argv[1][x] <= 122)
            {
                key[x] = argv[1][x] - 97;
            }
            
            // If there are non-alphabetic chars in the keyword, exit program
            else
            {
                printf("Don't do that!\n");
                return 1;
            }
        }
        
        // Retrieve plaintext from the user
        string p = GetString();
        
        /* 
        Now we use a "for" loop to cipher each letter
        the variable i counts through the letters
        keyplace also counts through the letters, but unlike i, keyplace
        does not shift when you find a non-alphabetic character 
        modulo makes it so you are always looking in an existing block
        of memory in array key
        */
        for (int i = 0, strlenp = strlen(p), modulo = strlen(argv[1]), 
        keyplace = 0; i < strlenp; i++, keyplace++)
        {
            // Shifting every capital letter
            if (p[i] >= 65 && p[i] <= 90)
            {
                printf("%c", 65 + (p[i] - 65 + key[keyplace % modulo]) % 26);
            }
            
            // Shifting every lowercase letter
            else if (p[i] >= 97 && p[i] <= 122)
            {
                printf("%c", 97 + (p[i] - 97 + key[keyplace % modulo]) % 26);
            }
            
            // Printing out non-letter characters as they are
            else
            {
                printf("%c", p[i]);
                keyplace--;
            }
        }
        printf("\n");
        
        // Success!!
        return(0);
    }
}