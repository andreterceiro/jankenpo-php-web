<html>
    <head>
        <title>Jankenpo</title>
        <meta charset="utf-8" />
        <style>
            input[type=submit] {
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        Selecione uma opção:

        <form method="POST">
            <div>
                <input type="radio" name="option" value="1"><img src="../assets/paper.png" />
            </div>
            <div>
                <input type="radio" name="option" value="2"><img src="../assets/rock.png" />
            </div>
            <div>
                <input type="radio" name="option" value="3"><img src="../assets/scissors.png" />
            </div>
            <input type="submit" value="Jogar"></submit>
        </form>

        <hr />

        <div>
            Winner: {$stringWinner}
        </div>
    </body>
</html>