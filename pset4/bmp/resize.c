/**
 * resize.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Resizes a BMP.
 */
       
#include <stdio.h>
#include <stdlib.h>

#include "bmp.h"

int main(int argc, char* argv[])
{
    // ensure proper usage
    if (argc != 4)
    {
        printf("Usage: ./resize n infile outfile\n");
        return 1;
    }

    // remember filenames and scaling factor
    int n = atoi(argv[1]);
    if (n < 0 || n > 100)
    {
        printf("Please enter scaling factor between 1 and 100\n");
        return 5;
    }
    char* infile = argv[2];
    char* outfile = argv[3];

    // open input file 
    FILE* inptr = fopen(infile, "r");
    if (inptr == NULL)
    {
        printf("Could not open %s.\n", infile);
        return 2;
    }

    // open output file
    FILE* outptr = fopen(outfile, "w");
    if (outptr == NULL)
    {
        fclose(inptr);
        fprintf(stderr, "Could not create %s.\n", outfile);
        return 3;
    }

    // read infile's BITMAPFILEHEADER
    BITMAPFILEHEADER bf;
    fread(&bf, sizeof(BITMAPFILEHEADER), 1, inptr);

    // read infile's BITMAPINFOHEADER
    BITMAPINFOHEADER bi;
    fread(&bi, sizeof(BITMAPINFOHEADER), 1, inptr);

    // ensure infile is (likely) a 24-bit uncompressed BMP 4.0
    if (bf.bfType != 0x4d42 || bf.bfOffBits != 54 || bi.biSize != 40 || 
        bi.biBitCount != 24 || bi.biCompression != 0)
    {
        fclose(outptr);
        fclose(inptr);
        fprintf(stderr, "Unsupported file format.\n");
        return 4;
    }
    
    // remember some values for later
    int origWidth = bi.biWidth;
    int origHeight = abs(bi.biHeight);
    
    bi.biWidth = n * bi.biWidth;
    bi.biHeight = n * bi.biHeight;
    
    // determine padding for scanlines
    int padding =  (4 - (bi.biWidth * sizeof(RGBTRIPLE)) % 4) % 4;
    int origPadding = (4 - (origWidth * sizeof(RGBTRIPLE)) % 4) % 4;
    
    // adjusting some other info in the outfile
    bi.biSizeImage = -bi.biHeight * (bi.biWidth * sizeof(RGBTRIPLE) + padding);
    bf.bfSize = 0x36 + bi.biSizeImage;
    
     // write outfile's BITMAPFILEHEADER
    fwrite(&bf, sizeof(BITMAPFILEHEADER), 1, outptr);
    
    // write outfile's BITMAPINFOHEADER
    fwrite(&bi, sizeof(BITMAPINFOHEADER), 1, outptr);

    // iterate over infile's scanlines
    for (int i = 0; i < origHeight; i++)
    {
        // temporary storage
        RGBTRIPLE remember[origWidth];
        
        // iterate over pixels in scanline
        for (int j = 0; j < origWidth; j++)
        {
            
            // temporary storage
            RGBTRIPLE triple;
            
            // read RGB triple from infile and remember it
            fread(&triple, sizeof(RGBTRIPLE), 1, inptr);
            remember[j] = triple;
        }
        // skip over padding, if any
        fseek(inptr, origPadding, SEEK_CUR);
        
        // writing the same row n number of times
        for (int y = 0; y < n; y++)
        {
            for (int x = 0; x < origWidth; x++)
            {
                for (int q = 0; q < n; q++)
                {
                    fwrite(&remember[x], sizeof(RGBTRIPLE), 1, outptr);
                }
            }

            // then add it back (to demonstrate how)
            for (int k = 0; k < padding; k++)
            {
                fputc(0x00, outptr);
            }
        }
    }

    // close infile
    fclose(inptr);

    // close outfile
    fclose(outptr);

    // that's all folks
    return 0;
}
