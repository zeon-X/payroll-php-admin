const headerContent = `
<div class="navbar  max-w-[1440px] mx-auto">
<div class="flex-1">
    <a class="btn btn-ghost normal-case text-xl">Employee Salary</a>
</div>
<div class="flex-none">
    <ul class="menu menu-horizontal px-1">
        <li><a>Link</a></li>
        <li>
            <details>
                <summary>
                    Login/Register
                </summary>
                <ul class="p-2 bg-base-200 min-w-100 w-full">
                    <li><a href="./login.html" class="">Login</a></li>
                    <li><a href="./reg.html" class="">Register</a></li>
                </ul>
            </details>
        </li>
    </ul>
</div>
</div>

`;

const footerContent = `
<div class=" footer p-10  text-neutral-content max-w-[1440px] mx-auto ">
            <div>
                <span class="footer-title">Services</span>
                <a class="link link-hover">Branding</a>
                <a class="link link-hover">Design</a>
                <a class="link link-hover">Marketing</a>
                <a class="link link-hover">Advertisement</a>
            </div>
            <div>
                <span class="footer-title">Company</span>
                <a class="link link-hover">About us</a>
                <a class="link link-hover">Contact</a>
                <a class="link link-hover">Jobs</a>
                <a class="link link-hover">Press kit</a>
            </div>
            <div>
                <span class="footer-title">Legal</span>
                <a class="link link-hover">Terms of use</a>
                <a class="link link-hover">Privacy policy</a>
                <a class="link link-hover">Cookie policy</a>
            </div>
        </div>
`;

// let headerNav = document.createElement("div");
// headerNav.innerHTML = headerContent;
// const headerDiv = document.getElementById("header");
// headerDiv.appendChild(headerNav);

let footerNav = document.createElement("div");
footerNav.innerHTML = footerContent;
const footerDiv = document.getElementById("footer");
footerDiv.appendChild(footerNav);
