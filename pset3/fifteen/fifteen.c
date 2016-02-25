/**
 * Elbert Gong, CS50 2015 Fall Term
 * fifteen.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Implements Game of Fifteen (generalized to d x d).
 *
 * Usage: fifteen d
 *
 * whereby the board's dimensions are to be d x d,
 * where d must be in [DIM_MIN,DIM_MAX]
 *
 * Note that usleep is obsolete, but it offers more granularity than
 * sleep and is simpler to use than nanosleep; `man usleep` for more.
 */
 
#define _XOPEN_SOURCE 500

#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

// constants
#define DIM_MIN 3
#define DIM_MAX 9

// board
int board[DIM_MAX][DIM_MAX];

// dimensions
int d;

// prototypes
void clear(void);
void greet(void);
void init(void);
void draw(void);
bool move(int tile);
bool won(void);

int main(int argc, string argv[])
{
    // ensure proper usage
    if (argc != 2)
    {
        printf("Usage: fifteen d\n");
        return 1;
    }

    // ensure valid dimensions
    d = atoi(argv[1]);
    if (d < DIM_MIN || d > DIM_MAX)
    {
        printf("Board must be between %i x %i and %i x %i, inclusive.\n",
            DIM_MIN, DIM_MIN, DIM_MAX, DIM_MAX);
        return 2;
    }

    // open log
    FILE* file = fopen("log.txt", "w");
    if (file == NULL)
    {
        return 3;
    }

    // greet user with instructions
    greet();

    // initialize the board
    init();

    // accept moves until game is won
    while (true)
    {
        // clear the screen
        clear();

        // draw the current state of the board
        draw();

        // log the current state of the board (for testing)
        for (int i = 0; i < d; i++)
        {
            for (int j = 0; j < d; j++)
            {
                fprintf(file, "%i", board[i][j]);
                if (j < d - 1)
                {
                    fprintf(file, "|");
                }
            }
            fprintf(file, "\n");
        }
        fflush(file);

        // check for win
        if (won())
        {
            printf("ftw!\n");
            break;
        }

        // prompt for move
        printf("Tile to move: ");
        int tile = GetInt();
        
        // quit if user inputs 0 (for testing)
        if (tile == 0)
        {
            break;
        }

        // log move (for testing)
        fprintf(file, "%i\n", tile);
        fflush(file);

        // move if possible, else report illegality
        if (!move(tile))
        {
            printf("\nIllegal move.\n");
            usleep(500000);
        }

        // sleep thread for animation's sake
        usleep(500000);
    }
    
    // close log
    fclose(file);

    // success
    return 0;
}

/**
 * Clears screen using ANSI escape sequences.
 */
void clear(void)
{
    printf("\033[2J");
    printf("\033[%d;%dH", 0, 0);
}

/**
 * Greets player.
 */
void greet(void)
{
    clear();
    printf("WELCOME TO GAME OF FIFTEEN\n");
    usleep(2000000);
}

/**
 * Initializes the game's board with tiles numbered 1 through d*d - 1
 * (i.e., fills 2D array with values but does not actually print them).  
 */
void init(void)
{
    // checks if dimensions are odd
    if (d == 3 || d == 5 || d == 7 || d == 9)
    {
        
        // puts values into array "board" for all rows except last
        int i;
        for (i = 0; i < d - 1; i++)
        {
            for (int j = 0; j < d; j++)
            {
                board[i][j] = d * d - j - (d * i) - 1;
            }
        }
        
        // puts values into array in last row, leaving one space open
        if (i == d - 1)
        {
            for (int j = 0; j < d - 1; j++)
            {
                board[i][j] = d * d - j - (d * i) - 1;
            }
        }
    }
    
    // checks if dimensions are even
    if (d == 4 || d == 6 || d == 8)
    {
        // puts values into array for all rows except last
        int i;
        for (i = 0; i < d - 1; i++)
        {
            for (int j = 0; j < d; j++)
            {
                board[i][j] = d * d - j - (d * i) - 1;
            }
        }
        
        // puts values into array for last row, switching order of last two #'s
        if (i == d - 1)
        {
            int j;
            for (j = 0; j < d - 3; j++)
            {
                board[i][j] = d * d - j - (d * i) - 1;
            }
            if (j == d - 3)
            {
                board[i][j] = d * d - j - (d * i) - 2;
                j++;
            }
            if (j == d - 2)
            {
                board[i][j] = d * d - j - (d * i);
                j++;
            }
        }
    }
    
    // puts a placeholder zero into the final spot in the array
    board[d - 1][d - 1] = 0;
}

/**
 * Prints the board in its current state.
 */
void draw(void)
{
    // performing for each row
    for (int i = 0; i < d; i++)
    {
        
        // performing for each column
        for (int j = 0; j < d; j++)
        {
            
            // prints the blank space 
            if (board[i][j] == 0)
            {
                printf("__  ");
            }
            else
            {
                
                // prints the number, with either 2 or 3 spaces after to line up
                printf("%i", board[i][j]);
                if (board[i][j] >= 10)
                {
                    printf("  ");
                }
                else
                {
                    printf("   ");
                }
            }
            
            // prints a new line if necessary
            if (j == d - 1)
            {
                printf("\n\n");
            }
        }
    }
}

/**
 * If tile borders empty space, moves tile and returns true, else
 * returns false. 
 */
bool move(int tile)
{
    
    // checks that you've inputted a valid tile number
    if (tile < 1 || tile > (d * d - 1))
    {
        return false;
    }
    else
    {
        int row;
        int column;
        // finds the row and column with the number you're looking for inside it
        for (int i = 0; i < d; i++)
        {
            for (int j = 0; j < d; j++)
            {
                if (board[i][j] == tile)
                {
                    row = i;
                    column = j;
                }
            }
        }
        
        // if there's a 0 below it and you're not in bottom row OR
        // there's a 0 above it and you're not in top row OR
        // there's a 0 right of it and you're not in righmost column OR
        // there's a 0 left of it and you're not in leftmost column
        if ((board[row + 1][column] == 0 && row != d - 1) || 
        (board[row - 1][column] == 0 && row != 0) || 
        (board[row][column + 1] == 0 && column != d - 1) || 
        (board[row][column - 1] == 0 && column != 0))
        {
            int zerorow;
            int zerocolumn;
            
            // finds the row and column of where the zero is located
            for (int i = 0; i < d; i++)
            {
                for (int j = 0; j < d; j++)
                {
                    if (board[i][j] == 0)
                    {
                        zerorow = i;
                        zerocolumn = j;
                        break;
                    }
                }
            }
            
            // swaps the values and returns true
            board[zerorow][zerocolumn] = board[row][column];
            board[row][column] = 0;
            return true;
        }
        
        // returns false if illegal move
        return false;
    }
}

/**
 * Returns true if game is won (i.e., board is in winning configuration), 
 * else false.
 */
bool won(void)
{
    // checks that elements in every row except the last are in correct order
    // if any element is not what it should be, return false
    int i;
    for (i = 0; i < d - 1; i++)
    {
        for (int j = 0; j < d; j++)
        {
            if (board[i][j] != j + (d * i) + 1)
            {
                return false;
            }
        }
    }
    
    // checks that elements in last row 
    // (except for one in last row and last column)
    // are in correct order
    if (i == d - 1)
    {
        for (int j = 0; j < d - 1; j++)
        {
            if (board[i][j] != j + (d * i) + 1)
            {
                return false;
            }
        }
    }
    
    // returns true if no mistakes are detected
    return true;
}