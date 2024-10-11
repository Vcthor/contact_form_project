<?php

// Class for contact form data
class ContactForm {
    public $fname;
    public $lname;
    public $age;
    public $contact;
    public $address;

    public function __construct($fname, $lname, $age, $contact, $address) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->contact = $contact;
        $this->address = $address;
    }

    // Display contact details
    public function display() {
        echo "<h3>Contact Details</h3>";
        echo "First Name: " . $this->fname . "<br>";
        echo "Last Name: " . $this->lname . "<br>";
        echo "Age: " . $this->age . "<br>";
        echo "Contact: " . $this->contact . "<br>";
        echo "Address: " . $this->address . "<br>";
    }
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Array to hold form data
    $formData = [
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'age' => $_POST['age'],
        'contact' => $_POST['contact'],
        'address' => $_POST['address']
    ];

    // Check if all fields are filled
    $allFieldsFilled = true;
    foreach ($formData as $key => $value) {
        if (empty($value)) {
            echo ucfirst($key) . " is required.<br>";
            $allFieldsFilled = false;
        }
    }

    // Conditional statement to check if age is valid
    if ($allFieldsFilled && $formData['age'] < 18) {
        echo "You must be at least 18 years old to submit this form.<br>";
    } else {
        // Create an instance of the ContactForm class
        $contactForm = new ContactForm(
            $formData['fname'],
            $formData['lname'],
            $formData['age'],
            $formData['contact'],
            $formData['address']
        );

        // Display contact details
        $contactForm->display();
    }

    // Example of an operator: check if contact is numeric
    if (!is_numeric($formData['contact'])) {
        echo "Contact number should contain only numbers.<br>";
    }

    // Loop example: Display entered data as a list
    echo "<h3>Entered Data</h3><ul>";
    foreach ($formData as $key => $value) {
        echo "<li>" . ucfirst($key) . ": " . htmlspecialchars($value) . "</li>";
    }
    echo "</ul>";
}
?>
