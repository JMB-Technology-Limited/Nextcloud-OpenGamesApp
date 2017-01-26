# Nextcloud app - OpenGames

## The Idea

Some public places, like office receptions, have a game set up with a marker for who's move it is.

![In Real Life](/build/screenshots/irl.jpg?raw=true "In Real Life")

Anyone passing can make a move.

This is a fun little thing. Let's do that in Nextcloud!

Enable this app and any user on a server can take part in a simple game!

## The app

Alice sees:

![Play1](/build/screenshots/play1.png?raw=true "Play")

She makes her move, and Bob sees:

![Play2](/build/screenshots/play2.png?raw=true "Play")

Bob plays his move, and Katie sees:

![Play3](/build/screenshots/play3.png?raw=true "Play")

Any user can make the next move at any time, so a player might end up playing both sides in one game.

After some more play, it's all over:

![Play4](/build/screenshots/play4.png?raw=true "Play")

Katie starts the new game, and the old game stays visible:

![Play5](/build/screenshots/play5.png?raw=true "Play")

Of course, sometimes everyone loses:

![Play6](/build/screenshots/play6.png?raw=true "Play")

If two players try and move at once, one will see:

![PlayError](/build/screenshots/playError.png?raw=true "Error")

## State of this

This was done as a learning exercise.

There are some things I know should be done to it.

If two players try and move at once it will detect that and stop the second move. However it would be better if the page
auto-updated for all players when one moved! A websocket connection, or even some JavaScript and an AJAX call that
checked every few seconds would help. This is probably the biggest thing it is missing.

Other minor features that would be nice:
  *  Store all moves of the game and show them as a small animation, as well as which player made them.
  *  Have simple comment/chat features for players as they play.
  *  Send notifications to players in a game when a new move is made and when the game is over.

In terms of code/app quality:
  *  There are some basic unit tests of the game engine but we could add more tests.
  *  Use SVG's instead of PNG's.
  *  It doesn't meet all code standards - eg spaces rather than tabs!
  *  It uses a database for storage; that might be a bit over the top but I wanted to see how databases worked. It doesn't
     use the database in the most effective/productive manner.
  *  There is currently a highlight over a row of the board applied in CSS - sort out where that is coming from. The
     CSS/Table HTML for the board could be cleaned up.

And finally, it's called OpenGames as maybe we could add more games later :-)
