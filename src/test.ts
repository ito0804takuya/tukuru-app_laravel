import {Selector, RequestLogger} from "testcafe";

const url = "http://13.231.189.5/login";
const emailInputArea = Selector(".form-control").withAttribute("name", "email");
const passwordInputArea = Selector(".form-control").withAttribute("name", "password");
const loginButton   = Selector(".loginBtn").withAttribute("name", "commit");
const logger = RequestLogger(url);

fixture("TUKURU")
    .page(url)
    .requestHooks(logger);

test
    .requestHooks(logger)
    ("Login Test", async (t) => {
    await t
        .typeText(emailInputArea, "tukuru@example.com")
        .typeText(passwordInputArea, "P@ssw0rd")
        .click(loginButton)
        .expect(logger.requests[0].response.statusCode).eql(200)
        .expect(Selector(".header__userName").innerText).eql('田中 創さん');
});