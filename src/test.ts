import "testcafe";
import {Selector} from "testcafe";

fixture("TUKURU Login")
    .page("http://13.231.189.5/login");

test("TUKURU Login Test", async (t) => {
    const emailInputArea = Selector(".form-control").withAttribute("name", "email");
    const passwordInputArea = Selector(".form-control").withAttribute("name", "password");
    const loginButton   = Selector(".loginBtn").withAttribute("name", "commit");

    await t
        .typeText(emailInputArea, "tukuru@example.com")
        .typeText(passwordInputArea, "P@ssw0rd")
        .click(loginButton)
        .expect(Selector(".header__userName").innerText).eql('田中 創さん');
});