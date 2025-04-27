<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit ebook</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .Editting_form {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .left_side, .right_side {
            display: inline-block;
            width: 45%;
            vertical-align: top;
            margin-right: 5%;
        }

        .right_side {
            margin-right: 0;
        }

        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            padding-left: 20px;
            color: red;
        }

        p {
            color: green;
        }

        /* Responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .left_side, .right_side {
                width: 100%;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>

    <div class="Editting_form">
        <h2>Edit eBook</h2>

            <div class="left_side">
                <input type="text" name="title" placeholder="Title"><br>
                <textarea name="description" placeholder="Description"></textarea><br>
                <input type="text" name="author" placeholder="Author"><br>
                <select name="status" required>
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select><br>

                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Filipiniana">Filipiniana</option>
                    <option value="Fiction">Fiction</option>
                    <option value="General Reference">General Reference</option>
                    <option value="Encyclopedia">Encyclopedia</option>
                    <option value="Senior High School">Senior High School</option>
                    <option value="Undergraduate">Undergraduate</option>
                    <option value="Graduate School">Graduate School</option>
                </select><br>
            </div>

            <div class="right_side">
                
                <label for="coverage">Upload Photo Cover</label><br>
                <input type="file" name="coverage" accept="image/*"><br>
                
                <label for="pdf">Upload PDF file</label><br>
                <input type="file" name="pdf" accept="application/pdf"><br>
    
                <input type="text" name="edition" placeholder="Edition"><br>
                <input type="text" name="publisher" placeholder="Publisher"><br>
                <input type="number" name="copyrightyear" placeholder="Copyright Year"><br>
                <input type="text" name="location" placeholder="Location"><br>
                <button type="submit">Upload eBook</button>
            </div>
        
    </div>

</body>
</html>