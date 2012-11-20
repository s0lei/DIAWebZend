<div id="menucontainer">
    <ul id="nav">
        <li>

            <a href="<?php echo $this->url(array('controller' => 'index',
                    'action' => 'index'));?>">Home</a>
            <ul>
            </ul>
        </li>
        <li>
            <a href="#">Search Departure Flight</a>
            <ul>
                <li>
                    <a href="<?php echo $this->url(array('controller' => 'departureflight',
                    'action' => 'index'));?>">All Flight</a>
                </li>
                <li>
                    <a href="<?php echo $this->url(array('controller' => 'departureflight',
                    'action' => 'airlineandtime'));?>">Airline + Time</a>
                </li>
                <li>
                    <a href="<?php echo $this->url(array('controller' => 'departureflight',
                    'action' => 'airlineandcity'));?>">Airline + City</a>
                </li>
                <li>
                    <a href="<?php echo $this->url(array('controller' => 'departureflight',
                    'action' => 'airlineflightnumber'));?>">Airline + Flight #</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Search Arrival Flight</a>
            <ul>
                <li>
                    <a href="<?php echo $this->url(array('controller' => 'index',
                    'action' => 'arrivalsearch'));?>">All Flight</a>
                </li>
                <li>
                    <a href="/DIAWeb/arrivalFlightSearch">Airline</a>
                </li>
                <li>
                    <a href="/DIAWeb/arrivalFlightSearch">Airline + Time</a>
                </li>
                <li>
                    <a href="/DIAWeb/arrivalFlightSearch">Airline + City</a>
                </li>
                <li>
                    <a href="/DIAWeb/arrivalFlightSearch">Airline + Flight #</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Search Connecting Flight</a>
            <ul>
                <li>
                    <a href="#">All Flight</a>
                </li>
                <li>
                    <a href="#">Airline</a>
                </li>
                <li>
                    <a href="#">Airline + Time</a>
                </li>
                <li>
                    <a href="#">Airline + City</a>
                </li>
                <li>
                    <a href="#">Airline + Flight #</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Contact</a>
            <ul>
                <li>
                    <a href="/DIAWeb/commentEmail">Comment</a>
                </li>
                <li>
                    <a href="/DIAWeb/about">About</a>
                </li>
            </ul>
        </li>
    </ul>
</div>