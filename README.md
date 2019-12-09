# ADISE19_ProjectDry

ADISE19_ProjectDry is a card game written in php.

## File Structure

```bash
.
├── css
│   └── dry.css
├── db
│   └── schema.sql
├── img
│   ├── 0.png
│   ├── 1.png
│   ├── ...
│   └── 52.png
├── js
│   └── dry.js
├── lib
│   ├── board.php
│   ├── dbconnect.php
│   └── game.php
├── .gitignore
├── README.md
├── dry.php
└── index.html
```

## API Overview

| URI | Method | Description | Return status |
| :-- | :----- | :---------- | :------------ |
| `/board` | **GET** | Gets the current board status. | *200(OK), 400(Bad Request)* |
| `/board` | **POST** | Resets the board and returns the current board status. | *200(OK), 400(Bad Request)* |
| `/board/card/{c}` | **GET** | Gets the current status of card {c}. | *200(OK), 400(Bad Request)* |
| `/board/card/{c}` | **PUT** | Moves the card {c} from a hand to the table. | *200(OK), 400(Bad Request)* |
| `/players` | **GET** | Gets all players' data. | *200(OK), 400(Bad Request)* |
| `/players/{p}` | **GET** | Gets the username of player {p}. | *200(OK), 400(Bad Request)* |
| `/players/{p}` | **PUT** | Sets the username of player {p}. | *200(OK), 400(Bad Request)* |
| `/status` | **GET** | Gets the game status. | *200(OK), 400(Bad Request)* |
