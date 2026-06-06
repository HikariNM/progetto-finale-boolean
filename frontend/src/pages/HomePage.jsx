import heroImage from '../assets/hero.png';
import homeImg01 from '../assets/homePageImg01.jpg';
import homeImg02 from '../assets/homePageImg02.jpg';

export default function HomePage() {
    return (
        <div className="home-container">

            <header
                className="hero-banner d-flex align-items-start justify-content-start text-start text-white"
                style={{
                    minHeight: '100vh',
                    backgroundImage: `url("${heroImage}")`,
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                    paddingTop: '120px',
                    paddingLeft: '2%'
                }}
            >
                <div>
                    <h1 className="display-3 fw-bold mb-0 text-uppercase tracking-wide">Starbound Kennel</h1>
                    <h2 className="h5 fw-light text-uppercase tracking-widest mt-1">Australian Shepherd</h2>
                </div>
            </header>


            <main className="container my-5 pt-5">
                <section className="about-us row justify-content-center">
                    <div className="col-lg-10">
                        <h3 className="border-bottom pb-2 mb-4 text-center text-uppercase font-monospace">About Us</h3>

                        <div className="clearfix">

                            <img
                                className="img-fluid float-start me-4 mb-3 rounded shadow"
                                src={homeImg01}
                                alt="About Starbound Kennel"
                                style={{ maxWidth: '300px', width: '100%' }}
                            />
                            <p className="lead text-justify">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, dolorum porro.
                                Quibusdam quas quaerat iste deleniti corporis assumenda accusamus distinctio sit veritatis
                                amet eos sequi aliquid pariatur, debitis deserunt. Itaque. Optio aliquid magnam, reiciendis
                                eligendi quibusdam eos voluptatem ad, enim, ab inventore voluptate officia explicabo?
                            </p>
                            <p>
                                Cumque optio laudantium tempora sequi explicabo, dolore velit molestiae, a minima sit porro,
                                facere aliquam. Deleniti exercitationem totam molestiae eligendi quasi fuga doloribus iure
                                optio, quae, excepturi aperiam recusandae id quas maiores vel possimus incidunt nulla esse.
                            </p>


                            <img
                                className="img-fluid float-end ms-4 mb-3 rounded shadow"
                                src={homeImg02}
                                alt="Our Australian Shepherd"
                                style={{ maxWidth: '300px', width: '100%' }}
                            />
                            <p>
                                Id blanditiis quaerat nam? Debitis, tempora natus laboriosam quidem minus iusto iusto delectus
                                non inventore nisi dignissimos sed assumenda similique rerum, blanditiis totam! Blanditiis
                                minima expedita a corporis cumque voluptatem voluptatibus. Veniam neque cum voluptas quam
                                aperiam deleniti quibusdam sequi, facere nobis hic vitae repudiandae aliquid.
                            </p>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    );
}