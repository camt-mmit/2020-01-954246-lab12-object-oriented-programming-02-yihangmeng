<?php
require_once './Truck.php';

printf("Input (owner cc): ");
fscanf(STDIN, "%s %d", $owner, $cc);
$truck = new Truck($owner, $cc);

while(true) {
    printf("command (h for help): ");
    $command = null;
    $value = null;
    fscanf(STDIN, "%s %d", $command, $value);
    if(strtolower($command) === 'e') break;
    switch(strtolower($command)) {
        case '0':
            $truck->engineStop();
        break;
        case '1':
            $truck->engineStart();
        break;
        case 'r':
            $truck->runFor($value);
        break;
        case 'p':
            $truck->load($value);
        break;
        case 'i':
            $truck->showLongInfo();
        break;
        case 'h':
            printf(
<<<EOT
 0 stop engine
 1 start engine
 r run for the given km
 p set payload with the given kg
 i show information (engine is off only)
 e exit
 h print this help

EOT
            );
        break;
        default:
            fprintf(STDERR, "Unkown command '%s' !!!\n", $command);
    }
}
