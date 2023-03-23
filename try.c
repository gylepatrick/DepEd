#include <stdio.h>

// Define the list of accounts
int accounts[3][2] = {{123, 456}, {789, 012}, {345, 678}};

int main() {
    int id, pin, i;
    printf("Enter ID: ");
    scanf("%d", &id);
    printf("Enter PIN: ");
    scanf("%d", &pin);
    // Check if the credentials match any account
    for (i = 0; i < 3; i++) {
        if (id == accounts[i][0] && pin == accounts[i][1]) {
            printf("Success!\n");
            return 0;
        }
    }
    printf("Invalid ID or PIN\n");
    return 1;
}
