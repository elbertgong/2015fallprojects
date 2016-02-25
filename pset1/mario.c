#include <stdio.h>
#include <cs50.h>
int main(void)
{
    int height;
   
   // Retrieves acceptable height from user using do-while loop
    do
    {
        printf("height: ");
        height = GetInt();
   }
   while (height < 0 || height > 23);
   
    int row=1;
    int column;
   
   // Creates a new row whenever there aren't enough rows
    while (row <= height)
    {
        column = 1;
       
      // Prints a # or space when there aren't enough characters in the row
        while (column <= height + 1)
        {
          
         // Prints a space
            if (column <= height - row)
            {
                printf(" ");
                column++;
           }
           
               // Prints a #
               else
            {
                printf("#");
                column++;
               }
      }
        printf("\n");
        row++;
   }
}