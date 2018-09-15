struct Ingrediente: Codable {

    var id: Int
    var name: String
    var tipo: String
    var descripcion: String?
    var stock: Double?
    var precio: Double?
    var impuesto_id: Int
    var created_at: String?
    var updated_at: String?

    var recetas: [Receta]
}
