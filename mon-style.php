<style>
.form {
    display: flex;
    justify-content: center;
    margin: 5%;
}

form {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    padding: 10px;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 50%;
}

.h4 {
    text-align: center;
    font-size: 20px;
    background-color: #17a2b8;
    padding: 10px;
    border-radius: 7px;
}

hr {
    margin: 10px 0;
    background-color: #ccc;
    height: 1px;
}

.username-div {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.username-div div {
    display: flex;
    flex-direction: column;
    width: 49%;
}

label {
    margin-bottom: 6px;
    color: #17a2b8;
}

input, textarea {
    margin-bottom: 5px;
    padding: 10px;
    border: 1px solid rgba(0, 0, 0, 0.4);
    border-radius: 6px;
    width: 100%;
    font-size: 14px;
}

input:focus, textarea:focus {
    border: 1px solid #17a2b8;
}

input[type="button"] {
    margin-top: 15px;
    background-color: #17a2b8;
    color: #fff;
    border: 1px solid #17a2b8;
    cursor: pointer;
    width: 20%;
}

.div-click1 {
    text-align: center;
    margin: auto;
}



/* Media Queries */
@media only screen and (max-width: 768px) {
    form {
        width: 80%;
    }

    .username-div div {
        width: 100%;
    }

    input[type="button"] {
        width: 50%;
        margin: auto;
    }
}

@media only screen and (max-width: 480px) {
    form {
        width: 90%;
    }

    input, textarea {
        font-size: 12px;
    }

    .username-div div {
        width: 100%;
    }

    input[type="button"] {
        width: 70%;
        margin: auto;
    }
    
}

/*  */
.obligatoire{
    color: red;
}

</style>