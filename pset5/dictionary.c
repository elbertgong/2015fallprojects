/**
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 */

#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>
#include <string.h>
#include <ctype.h>
#include <strings.h>

#include "dictionary.h"

// the nodes in my future hashtable
typedef struct node
{
    char word[LENGTH + 1];
    struct node* next;
}
node;

// my hashtable
#define BUCKETS 7919
node* hashtable[BUCKETS];

// an integer outside the functions (to make life easier in "size")
int totalwords = 0;


/**
 * Hashfunction. Takes a string and assigns it an int.
 */
int hash(const char* word)
{
    
    // hash function: I cited my source for this hash function in questions.txt
    int hashy = 0;
    for (int j = 0, m = strlen(word); j < m; j++)
    {
        char character = tolower(*(word + j));
        hashy = (character + (hashy << 6) + (hashy << 16) - hashy ) % BUCKETS;
    }
    return hashy;
}

/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word)
{
    
    // setting up my cursor to step through the particular linked list specified
    // by applying the hashfunction to the word in question
    node* cursor = hashtable[hash(word)];
    
    // stepping through the links of the linked list, if there are any
    while (cursor != NULL)
    {
        
        // if we have a match, return true :)
        if (strcasecmp(word, cursor->word) == 0)
        {

            return true;
        }
        cursor = cursor->next;
    }
    
    // if no match has been found, return false
    return false;
}

/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool load(const char* dictionary)
{

    // opening the dictionary file for reading
    FILE* inptr = fopen(dictionary, "r");
    if (inptr == NULL)
    {
        return false;
    }
    
    // variable for controlling the logical flow
    bool notendoffile = 0;
    
    while (notendoffile == 0)
    {
        // make a new node for the word
        node* new_node = malloc(sizeof(node));
    
        // if you've scanned to the end of file
        if (fscanf(inptr, "%s", new_node->word) == EOF)
        {
            notendoffile = 1;
            fclose(inptr);
            free(new_node);
            return true;
        }
        
        // get the hashvalue for the word you want to load
        int hashvalue = hash(new_node->word);
        
        // if it's the first word in its bucket, begin the first chain
        // of the linked list
        if (hashtable[hashvalue] == NULL)
        {
            hashtable[hashvalue] = new_node;
            new_node->next = NULL;
        }
            
        // if it's not the first word in its bucket, insert it at the top
        // of the linked list
        else
        {
            new_node->next = hashtable[hashvalue];
            hashtable[hashvalue] = new_node;
        }
        totalwords++;
    }
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded. 
 * But wait, if it hadn't loaded, we'd have exited the program already,
 * so we don't need to worry about that possibility.
 */
unsigned int size(void)
{
    return totalwords;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{
    
    // we want to free every linked list in the hashtable
    for (int i = 0; i < BUCKETS; i++)
    {
        
        // checking whether there actually is a linked at specified position
        if (hashtable[i] != NULL)
        {
            node* cursor = hashtable[i];
            
            // freeing each node step by step
            while(cursor != NULL)
            {
                node* temp = cursor;
                cursor = cursor->next;
                free(temp);
            }
        }
    }
    return true;
}