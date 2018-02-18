var GAME = {
    level:0,           // game level chosen by user
    rows: 0,           // rows in game board
    cols: 0,           // columns in gameboard
    bombs: 0,          // total bombs places on game board
    layout: undefined, // the matrix of game containing numbers (-1 = bomb, 0 = blank, number otherwise)
    Cells: undefined,  // the matrix of corresponding table cell dom elements
    openCellCount: 0,  // number of cells opened, used to determine winning condition
    startTime: 0,      // to store time when game starts
    time: 0,           // current time measurement in seconds
    timer: undefined,  // JavaScript timer object to setInterval
    flaggedCells: 0,   // total cells flagged by user
    bestScores: [      // hall of fame static array of objects
        {outcome:false, time:0}, // easy
        {outcome:false, time:0}, // medium
        {outcome:false, time:0}  // hard
    ] 
};

var clearBoard = function () {
    var element = document.getElementById("gameboard");
    while(element.firstChild)
    {
        element.removeChild(element.firstChild);
    }
    
    GAME.layout= new Array();
    // TODO: remove child nodes of element with id "gameboard"
    // TODO: reset layout to new array
}

var openCell = function (row, col) {
    // get the cell element belonging to that row and column
    var cell = GAME.Cells[row][col];
    cell.classList.remove("closed");
    cell.classList.add("open");
    // TODO: remove "closed" class and add "open" class to the cell element
    // https://www.w3schools.com/jsref/prop_element_classlist.asp
    //var con=createBackFaceContent(row,col);
    cell.appendChild(createBackFaceContent(row,col));
    // TODO: call createBackFaceContent to create the content of cell
    // and append the content to the cell element as a child
    GAME.openCellCount++;
    // TODO: increment total cell opened GAME.openCellCount
}

var openBoundary = function (row, col) {
    // INPUT:  row and column of blank cell opened
    // OUTPUT: call openCell for this cell and all cells around it until you hit a open or non blank cell
    // Note:   this will be a recursive method (backtracking)
    // get the cell element belonging to that row and column
    //var cell = GAME.Cells[row][col];
    if( row < 0 || col < 0 || row>=GAME.rows || col>=GAME.cols || GAME.Cells[row][col].classList.contains("open"))
        return;
    if(GAME.layout[row][col] >= 0){
              openCell(row,col);
              if(GAME.layout[row][col] == 0){
               var i, j;
              for(i = row - 1; i <= row + 1; i++)
                {
                 for(j = col - 1; j <= col + 1; j++){
                            openBoundary(i, j);
                       }
               }
            }
}

    
    // 1. if invalid row/col or cell is open, simply return
    //    To detect ifl is open, check if it has a class of "open"
    // 2. if it is a non-bomb cell (i.e. GAME.layout[row][col] >= 0) open the cell
    // 3. if it is a blank cell recurse for all eight neighbors
}

var endGame = function () {
    // remove flags and open all cells. Mark incorrectly marked flags
    for (var row = 0; row < GAME.rows; row++) {
        for (var col = 0; col < GAME.cols; col++) {
            var cell = GAME.Cells[row][col]; // fetch the cell dom element
            // if cell has a class of "closed" 
            if(cell.classList.contains("closed"))
            {
                openCell(row,col);
            }
            if(cell.getAttribute("marked"))
            {
                if(GAME.layout[row][col] != -1)
                {
                    cell.classList.add("Error");
                }
                /*else
                  cell.removeChild(cell.firstChild);*/
            }
            //      (use contains property of classList method )
            //      https://www.w3schools.com/jsref/prop_element_classlist.asp
            // open the cell that is closed
            // if cell is flagged (check if cell's "marked" attribure is set to "true")
            if(cell.getAttribute('marked')=='true')
                cell.removeChild(cell.firstChild);
            //      https://www.w3schools.com/jsref/met_element_getattribute.asp
            // then remove the flag (cell.firstchild) by using removeChild method on dom element
            //      https://www.w3schools.com/jsref/met_node_removechild.asp
            // if cell was marked but it does not have a bomb i.e. GAME.layout[row][col] != -1
            // then add "Error" class to the cell's dom element
        }
    }
    stopTimer();
}

var stopTimer = function () {
    if (GAME.timer) { // timer is not undefined
        //TODO: https://www.w3schools.com/jsref/met_win_clearinterval.asp
        clearInterval(GAME.timer);
        // clear Game.timer interval
    }
}

var updateHallOfFame = function(time, outcome) {
    var timeid = GAME.level + "time";
    var toonid = GAME.level + "toon";
    //
    if(outcome)
         document.getElementById(toonid).className = "gametoon icon-emo-sunglasses";
    else
         document.getElementById(toonid).className = "gametoon icon-emo-unhappy";
   document.getElementById(timeid).innerHTML = getFormattedTime(time);
}

var gameOver = function () {
    //TODO: call stopTimer method to end the clock
    stopTimer();
    document.getElementById("toon").className = "gametoon icon-emo-unhappy";
    updateHallOfFame(elapsedTimeInSeconds(), false);
}

var gameWon = function () {
    stopTimer();
    document.getElementById("toon").className = "gametoon icon-emo-sunglasses";
    updateHallOfFame(elapsedTimeInSeconds(), true);
}

var updateBombsRemaining = function(value) {

    document.getElementById("bombs").innerHTML=format(value,2);
    // TODO: set inner text of element with id "bombs" to the value 
    // use exactly 2 places (use leading 0 if single digit)
    // format method is given to you, use it.
}

var handleLeftClick = function (row, col) {
    // if first click, start game
    if(GAME.openCellCount==0) { // if no cell is open yet
        startGame(row, col); // call startGame
    }
    // process clicked cell
    if (validMove(row, col)) { // if user clicked on a closed cell
        if (GAME.layout[row][col] == -1) { // if it is a bomb cell
            //GAME OVER
             endGame(); // call end game as you blasted a bomb
            // make our gametoon unhappy

            document.getElementById("toon").className = "gametoon icon-emo-unhappy";
            GAME.Cells[row][col].classList.add("blast");
            

            // TODO: add "blast" class to the cell having the bomb clicked

            gameOver(); // call gameOver
        } else {
            // open many cells till  boundary
            openBoundary(row, col); // open boundary till you get nonblank cell
            // Note, above will open single cell if it is non blank, can you understand why?
        }
    }

}

var validMove = function (row, col) {
    if(GAME.Cells[row][col].classList.contains("closed"))
      return true; 
    return false;
    // TODO: return true if GAME.Cells[row][col] dom element has a class of "closed"
}

var toggleMarkCell = function (row, col, marked) {
    //place flag if not already there else remove it. 
    if (validMove(row, col)) {
        var cell = GAME.Cells[row][col];
        if (marked) {
            cell.setAttribute("marked",false);
            cell.removeChild(cell.firstChild);
            // TODO: set "marked" attribute of cell to "false"
            // TODO: remove cell.firstChild from cell
            GAME.flaggedCells--;
        } else {
            cell.setAttribute("marked",true);
            var i = document.createElement("i");
            i.setAttribute("class","red icon-golf");
            // TODO: set "marked" attribute of cell to "true"
            // TODO: create an "i" element and set its "Class" attribute to "red icon-golf"
            //    append that to cell
            cell.appendChild(i);
            GAME.flaggedCells++;
        }
    }
}

// following two methods handle middle click highlight neighbors feature
// see how these are implemented carefully
var indicateNeighbors = function (row, col) {
    var i, j;
    // for all neighboring cells
    for (i = row - 1; i <= row + 1; i++) {
        for (j = col - 1; j <= col + 1; j++) {
            if((i < GAME.rows && j < GAME.cols)&&(i != row && j != col)&&(GAME.Cells[row][col].classList.contains("closed")))
                cell.classList.add("indicate");
            //TODO: if i, j are valid and not the current row/col and the cell is closed
            //      add "indicate" class to cell
            // https://www.w3schools.com/jsref/prop_element_classlist.asp
        }
    }
}

var resetNeighbors = function (row, col) {
    var i, j;
    // for all neighboring cells
    for (i = row - 1; i <= row + 1; i++) {
        for (j = col - 1; j <= col + 1; j++) {
            if((i < GAME.rows && j < GAME.cols) &&(GAME.Cells[row][col].classList.contains("closed")))
                cell.classList.remove("indicate");
            //TODO: if i, j are valid and not the current row/col and the cell is closed
            //      remove "indicate" class from cell
            // https://www.w3schools.com/jsref/prop_element_classlist.asp
        }
    }
}
var handleMouseEvents = function (mouseButton, row, col, marked) {
    if (mouseButton == 0 && !marked) {
        // process left click (open cell, or boundary or blast bomb if clicked on bomb)
        handleLeftClick(row, col);
    } else if (mouseButton == 1) {
        //middle cl
        resetNeighbors(row, col);
    } else if (mouseButton == 2) {
        // put flag
        toggleMarkCell(row, col, marked);
    }
    if((GAME.openCellCount==(GAME.rows*GAME.cols)-GAME.bombs)||GAME.flaggedCells==(GAME.openCellCount-GAME.bombs))
    {
        gameWon();
    }
    // we win if we have either opened all cells GAME.openCellCount or marked them GAME.flaggedCells
    // do we know total number of cells in the game
    // TODO: check for winning condition, if true
    //       call gameWon() method
}

var createTD = function (row, col) {
    // https://www.w3schools.com/jsref/met_document_createelement.asp
    var cell = document.createElement("TD");
    cell.setAttribute("row",row);
    cell.setAttribute("col", col);
    cell.setAttribute("class", "closed");
    cell.setAttribute("marked", "false");
    // TODO: create "TD" element and set it to cell variable.
    //       Set following attributes on cell:
    //       "row" to value of row passed
    //       "col" to value of col passed
    //       "class" to "closed"
    //       "marked" to "false"
    //attach mouse button up event handler
    cell.onmouseup = function (event) {
        // make toon happy again
        document.getElementById("toon").className = "gametoon icon-emo-happy";
        // event.button tells which mouse button is clicked 0 = left, 1 = middle and 2 = right
        // we also pass row and col as well as marked attribute of the cell
        // see the handleMouseEvents method for more.
        handleMouseEvents(event.button,
            parseInt(cell.getAttribute("row")),
            parseInt(cell.getAttribute("col")),
            cell.getAttribute("marked") == 'true'
        );
    };

     //attach mouse button down event handler
    cell.onmousedown = function (event) {
        if (event.button == 0) { // left button down
            // make toon surprised
            document.getElementById("toon").className = "gametoon icon-emo-surprised";
        } else if (event.button == 1) { // middle button
            // highlight neighboring cells
            indicateNeighbors(
                parseInt(cell.getAttribute("row")),
                parseInt(cell.getAttribute("col"))
            );
        }
        //NOTE: return false is important, otherwise default middle click behavior will happen
        return false;
    }
    //disable context menu (default right click behavior)
    cell.oncontextmenu = function () { return false; }

    return cell;
}

// see how this method is implemented. It creates the content for the cell
// that you are opening
var createBackFaceContent = function (row, col) {
    var content;

    if (GAME.layout[row][col] == -1) { // if bomb
        content = document.createElement("i");
        content.setAttribute("class", "icon-bomb");
    
    } else if (GAME.layout[row][col] > 0) { // if number
        content = document.createElement("span");
        content.setAttribute("class", "font-" + GAME.layout[row][col]);
        content.appendChild(document.createTextNode(GAME.layout[row][col]));
    
    } 