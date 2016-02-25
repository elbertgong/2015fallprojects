/**
 * recover.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Recovers JPEGs from a forensic image.
 */
 
#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include <cs50.h>

int main(int argc, char* argv[])
{

    // open card.raw
    FILE* inptr = fopen("card.raw", "rb");
    if (inptr == NULL)
    {
        printf("Could not open card.raw.\n");
        return 2;
    }
    
    // create buffer
    typedef unsigned char  BYTE;
    BYTE buffer[512];
    
    FILE* outptr = NULL;
    char title[8];
    bool alreadyfound = false;
    bool filebegin = false;
    int counter = 0;

    // while loop checking for the end of the file
    while (fread(buffer, sizeof(BYTE), 512, inptr) == 512)
    {
        
        // if jpeg-beginning pattern is detected
        if (buffer[0] == 0xff && buffer[1] == 0xd8 && buffer[2] == 0xff &&
        (buffer[3] >= 0xe0 && buffer[3] <= 0xe1))
        {
            alreadyfound = true;
            
            // if this is the first jpg, open a new jpg outfile
            if (filebegin != true)
            {
                sprintf(title, "%03d.jpg", counter);
                outptr = fopen(title, "wb");
                filebegin = true;
            }
            
            // if this isn't the first jpg, close old outfile then open new one
            else
            {
                fclose(outptr);
                counter++;
                sprintf(title, "%03d.jpg", counter);
                outptr = fopen(title, "wb");
            }
        }
        
        // writing from the buffer into the outfile
        if (alreadyfound)
        {
            fwrite(buffer, sizeof(BYTE), 512, outptr);
        }
    }
    
    // close everything that's still open
    fclose(outptr);
    fclose(inptr);
}